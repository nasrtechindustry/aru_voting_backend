<?php

namespace App\Models;

use Carbon\Carbon;
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
        'year_id'
    ];

    protected $appends = ['full_name' , 'is_graduated' , 'profile'];


    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->middle_name . ' ' . $this->user->last_name;
    }


    public function getIsGraduatedAttribute()
    {
        return Carbon::now()->greaterThan(Carbon::createFromDate($this->end_date, 12, 31));

    }

    public function getProfileAttribute() {
        return $this->user->profile;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public  function user()
    {
        return $this->belongsTo(User::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
