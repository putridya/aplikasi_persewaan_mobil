<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = Customer::all();

        return view('user.customer.index')
            ->with('customer', $customer);
    }

    /**
     * Store a newly created customer in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required|string|max:255',
            'address_customer' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:20',
            'sim_number' => 'required|numeric|min:0', 
        ]);

        $customer = new Customer();
        $customer->name_customer = $request->input('name_customer');
        $customer->address_customer = $request->input('address_customer');
        $customer->telephone_number = $request->input('telephone_number');
        $customer->sim_number = $request->input('sim_number');
        $customer->save();

        return redirect()->back()->with('success', 'Customers added successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->back()->with('success', 'Data customer berhasil dihapus!');
    }
}
