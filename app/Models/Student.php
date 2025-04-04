<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{


    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'program_id',
        'user_id',
        'registration_number',
        'start_date',
        'end_date',
    ];

    protected $appends = ['full_name'];


    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }


    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public  function user()
    {
        return $this->belongsTo(User::class);
    }
}
