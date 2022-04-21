<?php

namespace App\Http\Controllers\Product;


use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "All Products";
        $parentCategory = Category::orderBy('id', 'DESC')->get();
        $childCategory = ChildCategory::orderBy('id', 'DESC')->with('category')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();
        $getData = Product::orderBy('id', 'DESC')->get();
       
        return view('partials.product.index', compact('suppliers', 'pageTitle',
         'getData', 'parentCategory','childCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'status' => 'required',
            'CategoryName' => 'required|string',
            'child_cat_id' => 'required|string',
            'supplier_id' => 'required|string',
            'product_code' => 'required|numeric',
            'warehouse' => 'required|string',
            'product_route' => 'required|string',
            'purchase_date' => 'required|string',
            'expire_date' => 'required|string',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/products/images/'), $filename);
        }

       $status= Product::create([
        'product_name' => $request->product_name,
        'status' =>  $request->status ,
        'CategoryName' => $request->CategoryName,
        'child_cat_id' => $request->child_cat_id ,
        'supplier_id' => $request->supplier_id,
        'product_code' => $request->product_code,
        'warehouse' => $request->warehouse,
        'product_route' => $request->product_route,
        'purchase_date' => $request->purchase_date,
        'expire_date' => $request->expire_date,
        'buying_price' => $request->buying_price,
        'selling_price' => $request->selling_price,
        'image'=>$filename
        ]);
        
        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Product added successfully ',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentCategory = Category::orderBy('id', 'DESC')->get();
        $childCategory = ChildCategory::orderBy('id', 'DESC')->with('category')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();
        $getData=Product::find($id);
        if($getData){
            return view('partials.product.edit', compact('getData','suppliers','childCategory','parentCategory'));
        }
        else{
            echo "Product not found";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string',
            'status' => 'required',
            'CategoryName' => 'required|string',
            'child_cat_id' => 'required|string',
            'supplier_id' => 'required|string',
            'product_code' => 'required|numeric',
            'warehouse' => 'required|string',
            'product_route' => 'required|string',
            'purchase_date' => 'required|string',
            'expire_date' => 'required|string',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $getData = Product::find($id);
        // dd($getData);
        $filename = $getData->image; // find the image that will update


        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/products/images/'), $filename);
            @unlink(public_path('backend/products/images/' . $getData->image));
        }
      
       $status= $getData->update([
        'product_name' => $request->product_name,
        'status' =>  $request->status ,
        'CategoryName' => $request->CategoryName,
        'child_cat_id' => $request->child_cat_id ,
        'supplier_id' => $request->supplier_id,
        'product_code' => $request->product_code,
        'warehouse' => $request->warehouse,
        'product_route' => $request->product_route,
        'purchase_date' => $request->purchase_date,
        'expire_date' => $request->expire_date,
        'buying_price' => $request->buying_price,
        'selling_price' => $request->selling_price,
        'image'=>$filename
        ]);
        
        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Product updated successfully ',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getData = Product::find($id);

        if ($getData) {
            # code...
            @unlink(public_path('backend/products/images/' . $getData->image));
            $getData->delete();
            return back();
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Data not found ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
