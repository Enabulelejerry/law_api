<?php

namespace App\Http\Controllers;

use App\Models\Headtype;
use Illuminate\Http\Request;

class HeadtypeController extends Controller
{
    
    public function GetheadType(){
        $getheadtype = Headtype::get();
        return response()->json([
            'data' => $getheadtype
          ],200);
    }
}
