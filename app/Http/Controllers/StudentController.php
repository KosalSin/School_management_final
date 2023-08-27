<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Classes;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(empty($request->input('queryString')))
        // {
        //     $students = Student::all()->paginate(5);
        // }else
        // {
            $classes = Classes::all();
            $queryString = $request->queryString;
            $students = Student::when($queryString != null, function($query) use ($queryString){
                return $query
                        ->where('student_name', 'like', '%'.$queryString.'%')
                        ->orWhere('gender', 'like', '%'.$queryString.'%');
            })->paginate(5);
        // }
        //dd($students->class_id);
        return view('admin.student.index', ['classes' => $classes, 'students' => $students, 'queryString' => $queryString ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Classes::all();
        return view('admin.student.create', ['data' => $data]);
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
            'student_name' => 'required',
            'gender' => 'required|not_in:0|in:Male,Female', 
            'phone_number' => 'required',
            'address' => 'required',
            'class_id' => 'required',

        ]);
        $student = new Student();
        $student->student_name = $request->student_name;
        $student->gender = $request->gender;
        $student->phone_number = $request->phone_number;
        $student->address = $request->address;
        $student->class_id = $request->class_id;
        $student->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $student->save();
        return redirect()->route('student.index')->with('success', 'Student has been added successfully!');

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
        $classes = Classes::all();
        $student = Student::all()->find($id);
        return view('admin.student.edit', ['student' => $student, 'classes' => $classes]);
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
            'student_name' => 'required',
            'gender' => 'required|not_in:0|in:Male,Female', 
            'phone_number' => 'required',
            'address' => 'required',
            'class_id' => 'required',

        ]);
        $student = Student::find($id);
        $student->student_name = $request->student_name;
        $student->gender = $request->gender;
        $student->phone_number = $request->phone_number;
        $student->address = $request->address;
        $student->class_id = $request->class_id;
        $student->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $student->save();
        return redirect()->route('student.index')->with('success', 'Student has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Student::findOrFail($id);
        $data->delete();
    }
}
