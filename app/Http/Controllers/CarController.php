<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $car = Car::all();

        return view('user.car.index')
            ->with('car', $car);
    }

    /**
     * Store a newly created car in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plat' => 'required|string|max:20|unique:cars,plat',
            'tarif' => 'required|numeric|min:0',
        ]);

        $car = new Car();
        $car->merk = $request->input('merk');
        $car->model = $request->input('model');
        $car->plat = $request->input('plat');
        $car->tarif = $request->input('tarif');
        $car->status = 'tersedia';
        $car->save();

        return redirect()->back()->with('success', 'Car added successfully!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->back()->with('success', 'Data car berhasil dihapus!');
    }
}
