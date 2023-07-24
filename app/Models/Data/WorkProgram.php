<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkProgram extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'work_program';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'work_program',
        'year',
        'general',
        'technical',
        'description',
        'progress',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
