<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle= "All Employees";

        $getData=Employee::all();
        return view('partials.employee.allEmployees',compact('pageTitle','getData'));
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
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/employee/images/'), $filename);
        }

       $data= Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'experience' => $request->experience,
            'address' => $request->address,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
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
        // $getData= Employee::find($id);
        // if($getData){
        //     return view('partials.employee.allEmployees');
        // }else{
        //     $notification=array(
        //         // 'T-messege' => 'welcome '.$request->name.'!',
        //         'T-messege' => 'No data found ',
        //         'alert-type'=>'error'
        //     );
        //     return back()->with($notification);
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $getData= Employee::find($id);
        //  dd($getData);
        if($getData){
           return response()->json([
            'status' => 200,
            'retrivedData' =>$getData
           ]);
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
