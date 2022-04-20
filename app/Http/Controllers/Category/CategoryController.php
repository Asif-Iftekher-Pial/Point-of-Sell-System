<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "All Categories";
        $getData = Category::orderBy('id', 'DESC')->get();
        $getChild = ChildCategory::orderBy('id', 'DESC')->with('category')->get();


        return view('partials.category.index', compact('pageTitle', 'getData', 'getChild'));
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
        $data = $request->all();
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $data = Category::create($data);
        if ($data) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Category created successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('category.index')->with($notification);
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
        $getData = Category::find($id);
        if ($getData) {
            return view('partials.category.edit', compact('getData'));
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Category not found',
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
        $getData = $request->all();
        $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $data = Category::find($id);
        if ($data) {
            $status = $data->fill($getData)->save();
            if ($status) {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Category updated successfully ',
                    'alert-type' => 'success'
                );
                return redirect()->route('category.index')->with($notification);
            }
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
        $getData = Category::find($id);
        if ($getData) {
            $status =  $getData->delete();
            if ($status) {
                return back();
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


    // child category section
    public function createChild(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'child_CatName' => 'required|string',
        ]);

        $status = ChildCategory::create($data);
        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Child category created successfully ',
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

    public function deleteChild($id)
    {
        //
        $getData = ChildCategory::find($id);
        if ($getData) {
            $status =  $getData->delete();
            if ($status) {
                return back();
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
    // public function deleteChild($id){
    //     $data=ChildCategory::find($id);
    //     if($data){
    //        $status= $data->delete();
    //        if($status){
    //         $notification = array(
    //             // 'T-messege' => 'welcome '.$request->name.'!',
    //             'T-messege' => 'Child Category deleted',
    //             'alert-type' => 'error'
    //         );
    //         return back()->with($notification);
    //        }
    //     }else {
    //         $notification = array(
    //             // 'T-messege' => 'welcome '.$request->name.'!',
    //             'T-messege' => 'Data not found',
    //             'alert-type' => 'error'
    //         );
    //         return back()->with($notification);
    //     }
    // }


    public function editChild($id)
    {
        $getData = ChildCategory::find($id);
        if ($getData) {
            return view('partials.category.editChild', compact('getData'));
        } else {
            return "No data found";
        }
    }

    public function updateChild(Request $request, $id)
    {
        $data = $request->all();
        $request->validate([
            'child_CatName' => 'required|string'
        ]);

        $update = ChildCategory::find($id);
        $status =  $update->fill($data)->save();
        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Category updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('category.index')->with($notification);
        }else{
            $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'something went wrong',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
        }
    }
}
