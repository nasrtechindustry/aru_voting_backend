<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'department_id' , 
        'program_name' , 
        'program_type' , 
        'duration' , 
        'description' , 
        'program_acronym'

    ];

    /**
     * Summary of department
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Department, Program>
     */
    public function department() {
        return $this->belongsTo(Department::class);
    }
}
