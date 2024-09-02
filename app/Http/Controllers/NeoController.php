<?php

namespace App\Http\Controllers;

use App\Services\NASA;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NeoController extends Controller
{
    /**
     * 1.Fastest Asteroid in km/h (Respective Asteroid ID & its speed)
     * 2.Closest Asteroid (Respective Asteroid ID & its distance)
     * 3.Average Size of the Asteroids in kilometers
     * 5. Plot a graph showing the total number of asteroids for each day of the given date range. Use a bar or line chart for the same.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function feed(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first(), "data" => null])->setStatusCode(422);
        }
        try {
            $neo = new NASA($request->input('start_date'), $request->input('end_date'));
            return response()->json(["status" => true, "message" => "NASA neo feed listing", "data" => [
                'fastest_asteroid' => $neo->fastest()->first(),
                'closest_asteroid' => $neo->closest()->first(),
                'average_asteroid' => $neo->average(),
                'chartBar' => [
                    "labels" => $neo->dailyCount()->keys(),
                    "datasets" => [[
                        "label" => '# of Asteroid',
                        "data" => $neo->dailyCount()->values(),
                        "borderWidth" => 1
                    ]]
                ],
            ]]);
        } catch (\Exception $exception) {
            return response()->json(["status" => false, "message" => "Something went wrong!", "data" => null])->setStatusCode(400);
        }
    }
}
