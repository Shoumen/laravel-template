<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('backend.pages.category.index',compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required | email | unique:customers',
            
        ]);
        $category = new Category();
        $category->date = date('Y-m-d');
        $category->name = $request->name;
        $category->created_by = auth()->user()->id;
        $category->save();
        toastr()->success('Category has been Updated successfully!');
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        return view('backend.category.show', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('backend.category.edit', ['id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->update([
            'name'=>$request->name,  
            'created_by'=>auth()->user()->id, 
        ]);
        toastr()->success('Category has been Updated successfully!');
        return back();
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
       
        $category->delete();
        // notify()->success('Customer deleted successfully');
        return back();
    }
}
