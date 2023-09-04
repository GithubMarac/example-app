<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\App;

class MealController extends Controller
{
    public function index(Request $request)
    {

        app()->setLocale($request->input('lang'));
        $diff_time = $request->input('diff_time');

        if($diff_time){
            $meals = Meal::withTrashed()
            ->tags($request->input('tags'))
            ->category($request->input('category'))
            ->paginate($request->input('per_page'));
        }else{
            $meals = Meal::query()
            ->tags($request->input('tags'))
            ->category($request->input('category'))
            ->paginate($request->input('per_page'));
        }


        return MealResource::collection($meals);
    }
}