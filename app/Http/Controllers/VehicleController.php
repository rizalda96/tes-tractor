<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function search(Request $request)
    {
        $query = $this->vehicle->get();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function store(Request $request)
    {
        $res = $this->vehicle->create([
            'vehicle_plate_no' => $request->plat_no,
            'vehicle_type' => $request->tipe,
        ]);

        return $this->redirectResponse($request, 'success', 'success', $res);
    }

    public function show(Request $request)
    {
        $query = $this->vehicle->where('id', $request->id)->first();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Vehicle::where('id', $id['id']);
        $query = $data->update([
            'vehicle_plate_no' => $request->plat_no,
            'vehicle_type' => $request->tipe,
        ]);

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function drop(Request $request)
    {
        $deleted = $this->vehicle->where(['id' => $request->id])->delete();
        $type = !$deleted ? 'error' : 'success';

        return $this->redirectResponse($request, $type, $type, $deleted);
    }
}
