<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'school_name' , 'school_acronym'
    ] ; 

    /**
     * Summary of appends
     * @var array
     */
    protected $appends = ['key'] ; 

    /**
     * Summary of getKeyAttribute
     */
    public function getKeyAttribute() {
        return $this->id ;
    }

}
