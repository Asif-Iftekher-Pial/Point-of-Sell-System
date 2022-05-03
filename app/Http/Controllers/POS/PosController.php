<?php

namespace App\Http\Controllers\POS;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\OrderDetail;
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
        // dd('ok');
        $qty = $request->qty;

        $data = Cart::update($rowId, $qty); // Will update the quantity
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

    public function createInvoice(Request $request)
    {
        $request->validate(
            [
                'customer_id' => 'required',
            ],
            [
                'customer_id.required' => 'Select a customer first',
            ]
        );

        $customer =  Customer::where('id', $request->customer_id)->first();
        $cart = Cart::content();
        // dd($cart);
        $invoicestr = Str::random(8);
        $orderstr =  Str::random(6);

        return view('partials.pos.invoice', compact('customer', 'cart', 'invoicestr', 'orderstr'));
    }
    public function submitInvoice(Request $request)
    {
        //   return $request->all();
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'shop_name' => 'required|string'
        ]);

        // $totalAmount =  Cart::total(); 
        $total = (float) str_replace(',', '', Cart::total());
        $totalAmount = floatval($total);
        //    dd($totalAmount);

       
        $order = new Order;
        $order->customer_id = $request->customer_id;
        $order->customer_name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->shop_name = $request->shop_name;
        $order->order_number = $request->orderNumber;
        $order->invoice_number = $request->invoiceNumber;
        $order->total_amount = $totalAmount;
        $order->partial_amount = $request->partial_amount;
        // $order->partial_paid = $request->partial_paid;
        
        $order->save();
        // dd($order);

        $finding = Order::find($order->id);
        //  dd($finding);
        $getpartialAmount= $finding->partial_amount;
        // convert partial amount
        $partial = (float) str_replace(',', '', $getpartialAmount); //taking  partial amount from request
        $partialAmount = floatval($partial);
        // dd($partialAmount);

        if ($partialAmount != null) {
            // dd(true);
            //convert total amount
            $check = $finding->total_amount;
            $total = (float) str_replace(',', '', $check);
            $totalAmount = floatval($total);
            
            if ($partialAmount > $totalAmount) {
                $notification = array(
                    'T-messege' => 'Partial amount cannot be more than total amount ',
                    'alert-type' => 'error'
                );
            } 
            else 
            {
                // dd('ok');
                $sum = $totalAmount - $partialAmount; 
                $finding->partial_amount = $partialAmount;
                $finding->due_amount = $sum;
                $finding->payment_status = "partial";
                $finding->partial_paid = "yes";
                $status = $finding->save();
                // dd($status);
                // Cart::destroy();
                if ($status) 
                {
                    // store data inProductDetail

                    $cartItem = Cart::content();
                    // dd($cartItem->id);
                    foreach ($cartItem as $value) {
    
                        $id = $value->id;
                        $pic =  Product::where('id', $id)->first();
                        //    dd($pic);
                        $img = $pic->image;
                        // dd($img);
                        $orderDetail = new OrderDetail;
                        $orderDetail->order_id = $finding->id;
                        $orderDetail->customer_id = $finding->customer_id;
                        $orderDetail->product_id = $value->id;
                        $orderDetail->product_name = $value->name;
                        $orderDetail->qty = $value->qty;
                        $orderDetail->price = $value->price;
                        $orderDetail->image = $img;
                        $secondstatus = $orderDetail->save();
                    }
                    if ($secondstatus) {
                        Cart::destroy();
                        $notification = array(
                            // 'T-messege' => 'welcome '.$request->name.'!',
                            'T-messege' => 'Congratulation ! Order placed successfully!',
                            'alert-type' => 'success'
                        );
                        return redirect()->route('pos.index')->with($notification);
                    } else {
                        $notification = array(
                            // 'T-messege' => 'welcome '.$request->name.'!',
                            'T-messege' => 'Something went wrong ',
                            'alert-type' => 'error'
                        );
                        return redirect()->route('pos.index')->with($notification);
                    }
                } else {
                    $notification = array(
                        // 'T-messege' => 'welcome '.$request->name.'!',
                        'T-messege' => 'Something went wrong ',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('pos.index')->with($notification);
                }
            }
        }
        else{
            // if there is no partial payment
            // dd('no partials');
            $check = $finding->total_amount;
            $total = (float) str_replace(',', '', $check);
            $totalAmount = floatval($total);
            $finding->payment_status = "paid";
            $status = $finding->save();

            if($status){
                // dd('order updated');
                 // store data inProductDetail

                 $cartItem = Cart::content();
                 // dd($cartItem->id);
                 foreach ($cartItem as $value) {
 
                     $id = $value->id;
                     $pic =  Product::where('id', $id)->first();
                     //    dd($pic);
                     $img = $pic->image;
                     // dd($img);
                     $orderDetail = new OrderDetail;
                     $orderDetail->order_id = $finding->id;
                     $orderDetail->customer_id = $finding->customer_id;
                     $orderDetail->product_id = $value->id;
                     $orderDetail->product_name = $value->name;
                     $orderDetail->qty = $value->qty;
                     $orderDetail->price = $value->price;
                     $orderDetail->image = $img;
                     $secondstatus = $orderDetail->save();
                 }
                 if ($secondstatus) {
                     Cart::destroy();
                     $notification = array(
                         // 'T-messege' => 'welcome '.$request->name.'!',
                         'T-messege' => 'Congratulation ! Order placed successfully!',
                         'alert-type' => 'success'
                     );
                     return redirect()->route('pos.index')->with($notification);
                 } else {
                     $notification = array(
                         // 'T-messege' => 'welcome '.$request->name.'!',
                         'T-messege' => 'Something went wrong ',
                         'alert-type' => 'error'
                     );
                     return redirect()->route('pos.index')->with($notification);
                 }

            }else{
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Something went wrong ',
                    'alert-type' => 'error'
                );
                return redirect()->route('pos.index')->with($notification);
            }
        
        }
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
