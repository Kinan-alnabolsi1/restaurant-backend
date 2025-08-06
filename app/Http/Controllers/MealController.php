<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMealRequest;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function store(StoreMealRequest $request)
    {
        $data = $request->validated();
        $image = $request->image;
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('meals', $newImageName, 'public');
        $data['image'] = $newImageName;
        $meal = Meal::create($data);
        return response()->json($meal, 201);
    }

    public function index()
    {
        return response()->json(Meal::with('category')->get());
    }

    public function byCategory(Category $category)
    {
        return response()->json($category->meals);
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
        return response()->json($meal);
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();
        return response()->json(['message' => 'Meal deleted successfully.']);
    }
}
