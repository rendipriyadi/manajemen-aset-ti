<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyActivity extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'daily_activity';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'executor',
        'users_id',
        'start_date',
        'finish_date',
        'work_category_id',
        'work_type_id',
        'location_room_id',
        'activity',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function users()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }
    // one to many
    public function detail_user()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\ManagementAccess\DetailUser', 'executor', 'user_id');
    }
    // one to many
    public function work_category()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Work\WorkCategory', 'work_category_id', 'id');
    }
    // one to many
    public function work_type()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Work\WorkType', 'work_type_id', 'id');
    }
    // one to many
    public function location_room()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Location\LocationRoom', 'location_room_id', 'id');
    }
}
