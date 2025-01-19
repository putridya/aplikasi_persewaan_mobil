<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $car = Car::where('status','tersedia')->get();
        $customer = Customer::all();
        $rental = Rental::where('is_returned',1)->get();
        $pengembalian = Rental::where('is_returned',0)->get();

        return view('user.sewa.index')
            ->with('car', $car)
            ->with('rental', $rental)
            ->with('pengembalian', $pengembalian)
            ->with('customer', $customer);
    }

    public function store(Request $request)
    {
        $car = Car::where('id',$request->input('car_id'))->first();
        $car->status = 'disewa';
        $car->save();

        $start = Carbon::parse($request->input('start_date'));
        $end = Carbon::parse($request->input('end_date'));
        $total_days = $start->diffInDays($end);
        $total_price = $total_days * $car->tarif;
        $rental = new Rental();
        $rental->customer_id = $request->input('customer_id');
        $rental->car_id = $request->input('car_id');
        $rental->start_date = $request->input('start_date');
        $rental->end_date = $request->input('end_date');
        $rental->total_price = $total_price;
        $rental->is_returned = 1;
        $rental->save();

        return redirect()->back()->with('success', 'Transaction added successfully!');
    }
    public function returned(Request $request)
    {
        $returned = Rental::where('id',$request->input('id'))->first();
        $returned->is_returned = 0;
        $returned->save();
        $car = Car::where('id',$returned->car->id)->first();
        $car->status = 'tersedia';
        $car->save();


        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->delete();

        return redirect()->back()->with('success', 'Data rental berhasil dihapus!');
    }
}
