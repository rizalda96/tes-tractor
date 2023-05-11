<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    public function search(Request $request)
    {
        $query = $this->driver->get();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function store(Request $request)
    {
        $res = $this->driver->create([
            'driver_name' => $request->fullname,
            'driver_phone' => $request->telp,
        ]);

        return $this->redirectResponse($request, 'success', 'success', $res);
    }

    public function show(Request $request)
    {
        $query = $this->driver->where('id', $request->id)->first();

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = Driver::where('id', $id['id']);
        $query = $data->update([
            'driver_name' => $request->fullname,
            'driver_phone' => $request->telp,
        ]);

        return $this->redirectResponse($request, 'success', 'success', $query);
    }

    public function drop(Request $request)
    {
        $deleted = $this->driver->where(['id' => $request->id])->delete();
        $type = !$deleted ? 'error' : 'success';

        return $this->redirectResponse($request, $type, $type, $deleted);
    }
}
