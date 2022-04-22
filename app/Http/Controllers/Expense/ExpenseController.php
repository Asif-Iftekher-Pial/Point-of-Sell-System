<?php

namespace App\Http\Controllers\Expense;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "All expense";
        $getData = Expense::orderBy('id', 'DESC')->get();
        return view('partials.expense.index', compact('pageTitle', 'getData'));
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
        $data = $request->all();
        $request->validate([
            'expenseDetail' => 'required|string',
            'amount' => 'required|numeric'
        ]);
        $saveData = Expense::create($data);
        if ($saveData) {
            $currentID = $saveData->id;
            $dataCreator = User::where('id', Auth::user()->id)->pluck('name')->first();
            $updateData = Expense::where('id', $currentID)->first();
            $updateData->UserName = $dataCreator;
            $status =  $updateData->save();
            if ($status) {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Expense created successfully',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            } else {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Something went wrong',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        } else {
            echo "Data did not save!!";
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
        $getData = Expense::find($id);
        if ($getData) {
            return view('partials.expense.edit', compact('getData'));
        } else {
            echo "Not found";
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
        $data = $request->all();
        $request->validate([
            'expenseDetail' => 'required|string',
            'amount' => 'required|numeric'
        ]);
        $currentUser = User::where('id', Auth::user()->id)->pluck('name')->first();
        // dd($currentUser);
        $findTable = Expense::find($id);

        $findTable->fill($data)->save();
        $findTable->UserName=$currentUser;
        $findTable->save();
        if ($findTable) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Expense updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('expense.index')->with($notification);
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Something went wrong',
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
    }
}
