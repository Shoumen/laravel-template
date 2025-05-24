<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        return view('backend.pages.customer.index',compact('customers'));
    }

    public function create()
    {
        return view('backend.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
            'phone' => 'required | unique:customers',
        ]);
        $customer = new Customer();
        $customer->date = date('Y-m-d');
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->personal_balance = $request->personal_blance ?? 0.00;
        $customer->due_balance = $request->personal_due ?? 0.00;
        $customer->created_by = auth()->user()->id;
        $customer->save();
        toastr()->success('Customer has been Updated successfully!');
        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        return view('backend.customers.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('backend.customers.edit', ['id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'personal_balance'=>$request->personal_blance,
            'due_balance'=>$request->personal_due,
            'created_by'=>auth()->user()->id, 
        ]);
        toastr()->success('Customer has been Updated successfully!');
        return back();
    }

    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        // $transactions = Transaction::where('customer_id', $id)->get();
        // foreach ($transactions as $transaction) {
        //     $transaction->delete();
        // }
        $customer->delete();
        toastr()->success('Customer has been Updated successfully!');
        return back();
    }
}
