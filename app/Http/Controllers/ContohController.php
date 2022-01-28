<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
class ContohController extends Controller
{
    public function contoh(){
        try{
        return response()->json(['Admin masuk']);
        }
        catch (Exception $e){
        return route('loginadmin');

        }
    }
}
