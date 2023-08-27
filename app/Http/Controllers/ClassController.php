<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Validator;


class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryString = $request->queryString;
        $classes = Classes::when($queryString != null, function($query) use ($queryString){
            return $query
                    ->where('class_name', 'like', '%'.$queryString.'%')
                    ->orWhere('status', 'like', '%'.$queryString.'%');
        })->paginate(5);
        return view('admin.class.index', ['classes'=>$classes, 'queryString'=>$queryString]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
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
            'class_name' => 'required',
            'status' => 'required|not_in:0|in:Active,Inactive', 
            
        ]);
        $class = new Classes();
        $class->class_name = $request->class_name;
        $class->status = $request->status;
        $class->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $class->save();
        return redirect()->route('classes.index')->with('success', 'Class has been added successfully!');
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
        $clas = Classes::find($id);
        return view('admin.class.edit', ['clas'=>$clas]);
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
            'class_name' => 'required',
            'status' => 'required|not_in:0|in:Active,Inactive',
          ]);
        $clas = Classes::find($id);
        //dd($clas->class_name);
        //dd($clas->status);
        $clas->class_name = $request->class_name;
        $clas->status = $request->status;
        $clas->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $clas->save();
        return redirect()->route('classes.index')->with('success', 'Class record has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Classes::findOrFail($id);
        $data->delete();
        return redirect()->route('classes.index')->with('success', 'Class record has been deleted successfully!');
    }
}
