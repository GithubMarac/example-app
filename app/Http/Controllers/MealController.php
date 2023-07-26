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

        $tags = explode(',', $request->input('tags'));
        $with = $request->input('with');

        //
        //Nisam stigao ovo zavrsiti, valjda ce biti dovoljno sto sam napisao do sada.....
        //
        
        $meals = Meal::whereHas('tags', function ($query) use($tags) {
            $query->whereIn('tag_id', $tags);
        })->filter([
                        'category' => $request->input('category'),
                        'diffTime' => $request->input('diffTime')])
                    ->paginate($request->input('per_page'));
        

        return MealResource::collection($meals);
    }
}