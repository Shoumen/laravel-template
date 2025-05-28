<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::transaction(function() use($request, $customer) {
            if ($customer->save()) {
                if ($request->personal_blance != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Personal Balance';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->customer_id = $customer->id;
                    $transaction->debit = $request->personal_blance; //as shop owner we have to pay this amount or advance
                    // so debit is payable
                    $transaction->credit = NULL;
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
                if ($request->personal_due != NULL) {
                    $transaction = new Transaction();
                    $transaction->transaction_type = 'Personal Due';
                    $transaction->date = Carbon::now()->format('Y-m-d');
                    $transaction->customer_id = $customer->id;
                    $transaction->debit = NULL;
                    $transaction->credit = $request->personal_due; //as shop owner we have to receive this amount
                    // so credit is receivable
                    $transaction->created_by = auth()->user()->id;
                    $transaction->save();
                }
            }
        });
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
        $transactions = Transaction::where('customer_id', $id)->get();
        foreach ($transactions as $transaction) {
            $transaction->delete();
        }
        $customer->delete();
        toastr()->success('Customer has been Updated successfully!');
        return back();
    }
}
