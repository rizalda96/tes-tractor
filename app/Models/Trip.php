<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'trip';
    protected $guarded = [];
    protected $appends = [
        'driver',
        'plat_no',
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function getDriverAttribute()
    {
        return $this->driver()->first()->driver_name;
    }

    public function getPlatNoAttribute()
    {
        return $this->vehicle()->first()->vehicle_plate_no;
    }
}
