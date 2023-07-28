<?php

namespace App\Models\MasterData\Location;

use App\Models\Data\Hardware\DeviceDivision;
use App\Models\Data\Hardware\DeviceUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function device_user()
    {
        return $this->hasMany(DeviceUser::class, 'location_id');
    }

    public function device_division()
    {
        return $this->hasMany(DeviceDivision::class, 'location_id');
    }
}
