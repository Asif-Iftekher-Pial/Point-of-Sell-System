<?php

namespace App\Http\Controllers\Employees;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "All Employees";
        $getData = Employee::orderBy('id', 'DESC')->get();
        return view('partials.employee.index', compact('pageTitle', 'getData'));
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
            'experience' => 'required|string',
            'salary' => 'required|numeric',
            'vacation' => 'required|string',
            'city' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/employee/images/'), $filename);
        }

        $data = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
        ]);
        $employeeID = $data->id;
        $employeeName = $data->name;
        $salaryAmount = $data->salary;

        $saralyInput = Salary::create([
            'employee_id' => $employeeID,
            'salaryAmount' => $salaryAmount,
            'employee_name' => $employeeName,
        ]);

        if ($data && $saralyInput) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Employee added successfully ',
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
        $getData = Employee::find($id);
        //  dd($getData);
        if ($getData) {
            return view('partials.employee.edit', compact('getData'));
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
        // dd('ok');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:employees',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'experience' => 'required|string',
            'salary' => 'required|numeric',
            'vacation' => 'required|string',
            'city' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $getData = Employee::find($id);
        // dd($getData);
        $filename = $getData->image; // find the image that will update


        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/employee/images/'), $filename);
            @unlink(public_path('backend/employee/images/' . $getData->image));
        }
        $data = $getData->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
        ]);
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Employee updated successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('employee.index')->with($notification);
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
        $getData = Employee::find($id);


        if ($getData) {
            # code...
            $deleteSalary = Salary::where('employee_id', $getData->id);
            if ($deleteSalary) {
                $deleteSalary->delete(); // delete salary column  related to employee id
                @unlink(public_path('backend/employee/images/' . $getData->image));
                $getData->delete();
                return back();
            } else {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Data not found ',
                    'alert-type' => 'error'
                );
            }
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Data not found ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }


    public function salarypayment()
    {
        $pageTitle = "All Salary";
        $getData = Salary::orderBy('id', 'DESC')->get();
        return view('partials.salary.index', compact('pageTitle', 'getData'));
    }

    public function editSalary($id)
    {
        $getData = Salary::find($id);
        if ($getData) {
            return view('partials.salary.edit', compact('getData'));
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'data not found ',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    public function salarypaymentUpdate(Request $request, $id)
    {
        $data = $request->all();
        $request->validate([
            'paymentStatus' => 'required',
            'bonus' => 'required|numeric',
            'date' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2022',
        ]);
        $Employeeid = $request->id;
        $paidMonth = $request->month;
        $existMonth = Salary::where('id', $Employeeid)
            ->where('month', $paidMonth)
            ->where('paymentStatus', 'paid')->first();
        // if $existMonth return null that means this months can insert data
        if ($existMonth === NULL) {
            // update data
            $save =  Salary::find($id);
            $status =  $save->fill($data)->save();
            if ($status) {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Salary Information Updated',
                    'alert-type' => 'success'
                );
                return redirect()->route('salaryManage')->with($notification);
            }
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Salary already paid in this month',
                'alert-type' => 'error'
            );
            return redirect()->route('salaryManage')->with($notification);
        }
        //dd($existMonth);

        // $data=  $getData->update([
        //     'paymentStatus' =>$request->paymentStatus,
        //     'bonus' => $request->bonus,
        //     'date'=> $request->date,
        //     'month'=> $request->month,
        //     'year'=> $request->year
        // ]);
        // if($data){
        //     $notification = array(
        //         // 'T-messege' => 'welcome '.$request->name.'!',
        //         'T-messege' => 'Salary Information Updated',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('salaryManage')->with($notification);
        // }
    }
}
