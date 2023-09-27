<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use App\Http\Resources\MealCollection;
use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\App;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $diff_time = $request->input('diff_time');
        $validated = $request->validate([
            'per_page' => 'numeric',
            'category' => 'max:10',
            'tags' => 'max:20',
            'with' => 'max:100',
            'lang' => 'required|max:5',
            'diff_time' => 'nullable|date'
        ]);

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


        return new MealCollection($meals);
    }

}