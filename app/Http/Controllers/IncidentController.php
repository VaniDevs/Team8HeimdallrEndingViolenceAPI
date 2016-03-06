<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Auth;
use App\Incident;
use Uuid;
use Storage;
use App\Media;
use File;

class IncidentController extends Controller
{
    public function alertIncident(Request $request)
    {
        if ($request->has('location')) {
            $incident = new Incident;
            if ($incident->sendIncident($request)) {
                return response()->json([
                    'code' => 200,
                    'incident_id' => $incident->uuid,
                    'message' => ['Alert has been sent']
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'message' => ['ERROR, RUNNNNNNN!']
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 400,
                'message' => ['Invalid Data']
            ], 400);
        }
    }

    public function resolveIncident(Request $request)
    {
        $user = Auth::guard('api')->user();

        if($user->is_admin) {
            $incident = Incident::where('uuid', $request->incident_id)->first();

            if ($incident != null && $incident->markIncident($request)) {
                return response()->json([
                    'code' => 200,
                    'message' => ['The incident was marked as resolved successfully']
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'message' => ['An error has occurred']
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 403,
                'message' => ['You do not have permission']
            ], 403);
        }
    }

    public function getIncidents(Request $request, $page = 1)
    {
        $user = Auth::guard('api')->user();

        if ($user->is_admin) {
            $num = ($page - 1) * 5;
            $incidents = Incident::skip($num)->take(5)->get();

            return response()->json([
                'code' => 200,
                'page' => $page,
                'incidents' => $incidents
            ]);
        } else {
            return response()->json([
                'code' => 403,
                'message' => ['You do not have permission']
            ], 403);
        }
    }

    public function uploadMedia(Request $request)
    {
        $user = Auth::guard('api')->user();

        $media = new Media;
        $media->user_id = $user->id;
        $media->uuid = Uuid::generate(4);

        if ($request->file('media')) {
            $upload_media = $request->file('media');

            Storage::put(
                'media/'.$media->uuid,
                file_get_contents($upload_media->getRealPath())
            );

            $media->save();

            return response()->json([
                'code' => 200,
                'message' => ['File was uploaded successfully']
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => ['File was not specified']
            ], 400);
        }
    }

    public function getMedia($uuid, Request $request)
    {
        $media = Media::where('uuid', $uuid);
        $path = storage_path() . '/app/media/' . $uuid;

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
