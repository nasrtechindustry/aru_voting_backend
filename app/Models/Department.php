<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $fillable = [
        'school_id',
        'department_name',
        'department_acronym'
    ];


    protected $appends = ['key'];

    public function getKeyAttribute()
    {
        return $this->id;
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function setDepartmentNameAttribute($value)
    {
        $this->attributes['department_name'] = Str::upper($value);
    }
}
