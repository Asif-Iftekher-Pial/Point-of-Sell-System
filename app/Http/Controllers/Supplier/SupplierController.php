<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "All Broker";
        $getData = Supplier::orderBy('id', 'DESC')->get();
        return view('partials.supplier.index', compact('pageTitle', 'getData'));
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
            'email' => 'required|unique:suppliers',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'type' => 'required',
            'shop' => 'required|string',
            'accountHolder' => 'required|string',
            'accountNumber' => 'required|numeric',
            'bankName' => 'required|string',
            'branchName' => 'required|string',
            'city' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/supplier/images/'), $filename);
        }

        $data = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'type' => $request->type,
            'shop' => $request->shop,
            'accountHolder' => $request->accountHolder,
            'accountNumber' => $request->accountNumber,
            'bankName' => $request->bankName,
            'branchName' => $request->branchName,
            'city' => $request->city,
        ]);
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Supplier added successfully ',
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
        //
        $getData = Supplier::find($id);
        //  dd($getData);
        if ($getData) {
            return view('partials.supplier.edit', compact('getData'));
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'No data found ',
                'alert-type' => 'error'
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:suppliers',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'type' => 'required',
            'shop' => 'required|string',
            'accountHolder' => 'required|string',
            'accountNumber' => 'required|numeric',
            'bankName' => 'required|string',
            'branchName' => 'required|string',
            'city' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $getData = Supplier::find($id);
        // dd($getData);
        $filename = $getData->image; // find the image that will update


        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/supplier/images/'), $filename);
            @unlink(public_path('backend/supplier/images/' . $getData->image));
        }
        $data = $getData->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'type' => $request->type,
            'shop' => $request->shop,
            'accountHolder' => $request->accountHolder,
            'accountNumber' => $request->accountNumber,
            'bankName' => $request->bankName,
            'branchName' => $request->branchName,
            'city' => $request->city,
        ]);
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Supplier updated successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('supplier.index')->with($notification);
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
        //
        $getData = Supplier::find($id);

        if ($getData) {
            # code...
            @unlink(public_path('backend/supplier/images/' . $getData->image));
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
