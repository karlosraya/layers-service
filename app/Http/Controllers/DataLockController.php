<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataLockController extends Controller
{
    public $successStatus = 200;

    public function lockData($date)
    {
        $user = Auth::user(); 


    }

    public function computeLockedData($date)
    {

    }
}
