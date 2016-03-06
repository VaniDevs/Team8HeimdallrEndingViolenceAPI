<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Auth;
use App\Incident;
use Uuid;

class IncidentController extends Controller
{
    public function alertIncident(Request $request)
    {
        if ($request->has('location')) {
            $incident = new Incident;
            if ($incident->sendIncident($request)) {
                return response()->json([
                    'code' => 200,
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
}
