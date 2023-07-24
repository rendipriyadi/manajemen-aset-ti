<?php

namespace App\Models\MasterData\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationDetail extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location_detail';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'location_id',
        'location_sub_id',
        'location_room_id',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function location()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\Location', 'location_id', 'id');
    }
    // one to many
    public function location_sub()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\LocationSub', 'location_sub_id', 'id');
    }
    // one to many
    public function location_room()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\LocationRoom', 'location_room_id', 'id');
    }
    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'location_detail_id');
    }
}
