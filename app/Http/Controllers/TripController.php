<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    protected $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    public function search(Request $request)
    {
        $query = $this->trip->get();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function store(Request $request)
    {
        $res = $this->trip->create([
            'actual_time' => $request->actual_time,
            'date' => $request->date,
            'distance' => $request->distance,
            'driver_id' => $request->driver,
            'vehicle_id' => $request->plat_no,
            'point_end' => $request->point_end,
            'point_start' => $request->point_start,
            'priceper_km' => $request->priceper_km,
            'standard_time' => $request->standard_time,
            'total_cost' => $request->total_cost,
        ]);

        return $this->redirectResponse($request, 'success', 'success', $res);
    }

    public function show(Request $request)
    {
        $query = $this->trip->where('id', $request->id)->first();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Trip::where('id', $id['id']);
        $query = $data->update([
            'actual_time' => $request->actual_time,
            'date' => $request->date,
            'distance' => $request->distance,
            'driver_id' => $request->driver,
            'vehicle_id' => $request->plat_no,
            'point_end' => $request->point_end,
            'point_start' => $request->point_start,
            'priceper_km' => $request->priceper_km,
            'standard_time' => $request->standard_time,
            'total_cost' => $request->total_cost,

        ]);

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function drop(Request $request)
    {
        $deleted = $this->trip->where(['id' => $request->id])->delete();
        $type = !$deleted ? 'error' : 'success';

        return $this->redirectResponse($request, $type, $type, $deleted);
    }
}
