<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return response()->json($cars, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'model' => 'required',
            'price' => 'required',
            'is_available' => 'nullable',
        ]);

        $car = Car::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'model' => $request->model,
            'price' => $request->price,
            'is_available' => $request->is_available,
        ]);

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return response()->json($car, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        if ($car->user_id !== request()->user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $car->update($request->all());

        return response()->json($car, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->user_id !== request()->user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $car->delete();

        return response()->json(null, 204);
    }
}
