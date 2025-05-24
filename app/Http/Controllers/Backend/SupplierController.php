<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        return view('backend.pages.supplier.index',compact('suppliers'));
    }
    public function create()
    {
        return view('backend.supplier.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
            'phone' => 'required | unique:suppliers',
        ]);
        $supplier = new Supplier();
        $supplier->date = date('Y-m-d');
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->personal_balance = $request->personal_blance ?? 0.00;
        $supplier->due_balance = $request->personal_due ?? 0.00;
        $supplier->created_by = auth()->user()->id;
        $supplier->save();
        toastr()->success('Supplier has been saved successfully!');
        return redirect()->route('supplier.index');
    }
    public function edit($id)
    {
        return view('backend.supplier.edit');
    }
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'personal_balance'=>$request->personal_blance,
            'due_balance'=>$request->personal_due,
        ]);
        toastr()->success('Supplier has been Updated successfully!');
        return back();
    }

     public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        // $transactions = Transaction::where('supplier_id', $id)->get();
        // foreach ($transactions as $transaction) {
        //     $transaction->delete();
        // }
        $supplier->delete();

        toastr()->success('Supplier has been Updated successfully!');
        return back();
    }
}
