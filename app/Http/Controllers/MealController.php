<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\App;

class MealController extends Controller
{
    public function index(Request $request)
    {

        app()->setLocale($request->input('lang'));

        // Perform the search query using the 'name' and 'description' fields
        $products = Meal::latest()
                           ->filter([$request->input('tags'),$request->input('category'),$request->input('with'),$request->input('diffTime')])
                           ->paginate($request->input('perPage'));

        return json_encode($products);
    }
}