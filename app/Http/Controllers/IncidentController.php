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
    public function sendAlert(Request $request)
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
                'code' => 500,
                'message' => ['Invalid Data']
            ], 400);
        }
    }
}
