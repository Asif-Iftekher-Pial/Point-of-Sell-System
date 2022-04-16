<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $pageTitle="All Customers";
        $getData = Customer::orderBy('id','DESC')->get();
        return view('partials.customer.index',compact('pageTitle','getData'));
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
            'name' => 'required|string',
            'email' => 'required|unique:employees',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|numeric',
            'bank_name' => 'required|string',
            'bank_branch' => 'required|string',
            'shop_name' => 'required|string',
            'city' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/customer/images/'), $filename);
        }

       $data= Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_branch' => $request->bank_branch,
            'bank_name' => $request->bank_name,
            'shop_name' => $request->shop_name,
            'city' => $request->city,
        ]);
        if($data){
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Employee added successfully ',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        }
        else{
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong ',
                'alert-type'=>'error'
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
        //
        $getData= Customer::find($id);
        //  dd($getData);
        if($getData){
         return view('partials.customer.edit',compact('getData'));
        }else{
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'No data found ',
                'alert-type'=>'error'
            );
            return back()->with($notification);
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
        //
        // dd('ok');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:employees',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|numeric',
            'bank_name' => 'required|string',
            'bank_branch' => 'required|string',
            'shop_name' => 'required|string',
            'city' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $getData=Customer::find($id);
        // dd($getData);
        $filename=$getData->image; // find the image that will update
    

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename =date('Ymdhms').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/customer/images/'), $filename);
            @unlink(public_path('backend/customer/images/'. $getData->image ));
        }
       $data= $getData->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'image' => $filename,
        'address' => $request->address,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_branch' => $request->bank_branch,
        'bank_name' => $request->bank_name,
        'shop_name' => $request->shop_name,
        'city' => $request->city,
        ]);
        if($data){
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Customer updated successfully ',
                'alert-type'=>'success'
            );
            return redirect()->route('customer.index')->with($notification);
        }
        else{
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong ',
                'alert-type'=>'error'
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
        $getData =Customer::find($id);
       
        if ($getData) {
            # code...
            @unlink(public_path('backend/customer/images/'. $getData->image ));
            $getData->delete();
            return back();
        }else{
            $notification=array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Data not found ',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
    }
}
