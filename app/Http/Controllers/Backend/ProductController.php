<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $categories = Category::all();
        return view('backend.pages.product.index');
    }

     public function create()
    {

        // $brands = Brand::all();
        // $categories = Category::all();
        // $variations = Variation::all();
        // $sizes = ProductSize::all();
        // $colors = ProductColor::all();
        // $units = Unit::all();
        // $suppliers = Supplier::all();
        return view('backend.pages.product.create');
    }

     public function store(Request $request)
    {
        // // dd($request->all());

        // $request->validate(
        //     [
        //         'name' => 'required|unique:products',
        //         'barcode' => 'unique:products',
        //         'category_id' => 'required',
        //         'unit_id' => 'required',
        //         'purchase_price' => 'required',
        //         'selling_price' => 'required',
        //         'status' => 'required',
        //     ],
        //     [
        //         'name.unique' => 'The product name has already been taken !',
        //         'barcode.unique' => 'The product barcode has already been taken !',
        //     ]
        // );

        // $product = new Product();
        // $product->name = $request->name;
        // $product->date = date('Y-m-d');
        // $numberBarcode = rand(000000, 999999);
        // if ($request->barcode == NULL) {
        //     $product->barcode = $numberBarcode;
        // } else {
        //     $product->barcode = $request->barcode;
        // }
        // $product->is_service = 0;
        // $product->category_id = $request->category_id;
        // $product->brand_id = $request->brand_id;
        // $product->unit_id = $request->unit_id;
        // $product->main_qty = $request->main_qty;
        // $product->has_serial = $request->has_serial;
        // $product->sub_qty = $request->sub_qty;
        // $product->purchase_price = $request->purchase_price;
        // $product->selling_price = $request->selling_price;
        // $product->status = $request->status;
        // $product->description = $request->description;
        // $product->created_by = Auth::user()->id;

        // if ($product->save()) {
        //     if ($request->size != null || $request->color != null) {
        //         $sizes = $request->size ?? [null];
        //         $colors = $request->color ?? [null];
        //         foreach ($sizes as $size) {
        //             foreach ($colors as $color) {
        //                 $product->product_variations()->create([
        //                     'product_id' => $product->id,
        //                     'size_id' => $size,
        //                     'color_id' => $color,
        //                 ]);
        //             }
        //         }
        //     }
        // }

        // $image = $request->file('images');
        // if ($image) {
        //     $imgName = date('YmdHi') . $image->getClientOriginalName();
        //     $image->move('public/uploads/products/', $imgName);
        //     $product->images = $imgName;
        // }
        // $product->save();
        // // if($request->main_qty != null || $request->main_qty != null && $request->sub_qty != null){
        // //     $this->open_stock_purchase($request, $product->id);
        // // }
        // notify()->success('Product created successfully!');
        return Redirect()->route('product.index');
    }
    public function edit(Request $request)
    {
        // $data['brands'] = Brand::all();
        // $data['categories'] = Category::all();
        // $data['sizes'] = ProductSize::all();
        // $data['colors'] = ProductColor::all();
        // $data['units'] = Unit::all();
        // $selectedVariations = ProductVariation::where('product_id', $id)->get();
        // $data['selectedColorIds'] = $selectedVariations->pluck('color_id')->unique()->toArray();
        // $data['selectedSizeIds'] = $selectedVariations->pluck('size_id')->unique()->toArray();
        // $data['data'] = Product::with(['brand', 'category', 'unit.related_unit'])->where('id', $id)->first();
        return view('backend.pages.product.edit');
    }

}
