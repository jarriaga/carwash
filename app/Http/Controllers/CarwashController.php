<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Alert;
use App\Service;

class CarwashController extends BaseController
{

    /**
    * Method to return the main index screen
    */
    public function getIndex(Request $request)
    {
      return view('carwash');
    }

    /**
    * Method to search if car has been stolen given the license plate
    */
    public function getAlert($plate, Request $request)
    {
        $plateWasFound = Alert::where('plate', $plate)->first();
        if($plateWasFound){
          return response()->json(['alert'=>1,'message'=>'Car has been reported as stolen'],200);
        }
        return response()->json(['alert'=>0,'message'=>'No alerts for this car'],200);
    }


    /**
    *
    * Method to know and  send total visits for license plate
    **/
    public function getLoyalty($plate,Request $request)
    {
      $services = Service::where('plate', $plate)->count();
      if($services>0){
        return response()->json(['loyalty_discount'=>0.50,'visits'=>$services],200);
      }
      return response()->json(['loyalty_discount'=>0,'visits'=>0],200);
    }

}
