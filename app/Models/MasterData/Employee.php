<?php

namespace App\Models\MasterData;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'employee';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'nip',
        'name',
        'job_position',
        'division_id',
        'department_id',
        'section_id',
        'company',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function division()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Division', 'division_id', 'id');
    }
    // one to many
    public function department()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Department', 'department_id', 'id');
    }
    // one to many
    public function section()
    {
        // 3 parameter (path model, field foreign key, field primary key from table hasMany/hasOne)
        return $this->belongsTo('App\Models\MasterData\Division\Section', 'section_id', 'id');
    }

    // one to many
    public function device_pc()
    {
        // 2 parameter (path model, field foreign key)
        return $this->hasMany('App\Models\Data\Hardware\DeviceUser', 'employee_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }
}
