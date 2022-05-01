<?php

namespace App\Http\Controllers\POS;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Point of Sell";
        $customers = Customer::get();
        $parentCategory = Category::orderBy('id', 'DESC')->get();
        $childCategory = ChildCategory::orderBy('id', 'DESC')->with('category')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();
        $getData = Product::where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('partials.pos.index', compact('customers', 'suppliers', 'parentCategory', 'childCategory', 'getData', 'pageTitle'));
    }

    public function addtocart($id)
    {
        $selectedProduct = Product::where(['id' => $id], ['status' => 'active'])->orderBy('id', 'DESC')->first();
        $data = Cart::add([
            'id' =>  $selectedProduct->id,
            'name' =>  $selectedProduct->product_name,
            'qty' => 1,
            'price' =>  $selectedProduct->selling_price,
            'weight' => 0,
        ]);
        // dd($data);
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Item added in the invoice',
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

    public function deleteCart($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'Item removed from the invoice',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function updateCart(Request $request, $rowId)
    {
        $qty= $request->qty;
   
       $data= Cart::update($rowId, $qty); // Will update the quantity
       if ($data) {
        $notification = array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'Item updated in the invoice',
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

    public function createInvoice(Request $request){
        $request->validate([
            'customer_id' => 'required',
        ],
        [
            'customer_id.required' =>'Select a customer first',
        ]);
         
    $customer=  Customer::where('id',$request->customer_id)->first();
    $cart= Cart::content();
    // dd($cart);
    $invoicestr= Str::random(8);
    $orderstr=  Str::random(6);
   
    return view('partials.pos.invoice', compact('customer','cart','invoicestr','orderstr'));
        
       
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
