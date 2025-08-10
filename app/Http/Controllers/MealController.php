<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMealRequest;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function store(StoreMealRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newImageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('meals', $newImageName, 'public');
            $data['image'] = $newImageName;
        }

        $meal = Meal::create($data);
        $meal->image = asset('storage/meals/' . $meal->image);

        return response()->json($meal, 201);
    }

    public function index()
    {
        $meals = Meal::with('category')->get();

        
        $meals->transform(function ($meal) {
            $meal->image = asset('storage/meals/' . $meal->image);
            return $meal;
        });

        return response()->json($meals);
    }

    public function byCategory(Category $category)
    {
        $meals = $category->meals->map(function ($meal) {
            $meal->image = asset('storage/meals/' . $meal->image);
            return $meal;
        });

        return response()->json($meals);
    }

    public function update(StoreMealRequest $request, Meal $meal)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newImageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('meals', $newImageName, 'public');
            $data['image'] = $newImageName;
        }

        $meal->update($data);
        $meal->image = asset('storage/meals/' . $meal->image);

        return response()->json($meal);
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();
        return response()->json(['message' => 'Meal deleted successfully.']);
    }
}
