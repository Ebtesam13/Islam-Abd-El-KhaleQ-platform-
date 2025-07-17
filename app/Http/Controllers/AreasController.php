<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function getAreasByCityId($cityId){
        return Area::query()->where('city_id',$cityId)->get();
    }
}
