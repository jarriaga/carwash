<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class CarwashController extends BaseController
{

    /**
    * Method to return the main index screen
    */
    public function getIndex(Request $request)
    {
      return view('carwash');
    }


}
