<?php

namespace App\Models\MasterData\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationRoom extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'location_room';

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

    // one to many
    public function location_detail()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\MasterData\Location\LocationRoom', 'location_room_id');
    }
    // one to many
    public function daily_activity()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\DailyActivity', 'location_room_id');
    }
}
