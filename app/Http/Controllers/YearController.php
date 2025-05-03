<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends BaseController
{
    public function index() {
        return  $this->successResponse('All years of studies' , Year::all() , 200);
    }
}
