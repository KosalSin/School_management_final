<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Attendant;
use Attribute;
use DateTime;

class AttendantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryString = $request->queryString;
        $attendants = Attendant::Join('students', 'students.id', '=', 'attendants.student_id')
                    ->select('attendants.id', 'attendants.student_id', 'students.student_name', 'attendants.tran_date', 'attendants.attendant', 'attendants.created_by')
                    ->orderBy('tran_date', 'DESC')
                    ->when($queryString != null, function($query) use ($queryString){
                    return $query
                    ->where('students.student_name', 'like', '%'.$queryString.'%')
                    ->orWhere('tran_date', 'like', '%'.$queryString.'%');
        })->paginate(5);
        return view('admin.attendant.index', ['attendants'=>$attendants, 'queryString'=>$queryString]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.attendant.create', ['students' => $students]);
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
            'attendant' => 'required|in:Yes,No', 
    
        ]);
        $attendant = new Attendant();
        $attendant->student_id = $request->student_name;
        $attendant->attendant = $request->attendant;
        $attendant->tran_date = (new DateTime);
        $attendant->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $attendant->save();
        return redirect()->route('attendant.index')->with('success', 'Attendant has been marked successfully!');

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
        $students = Student::all();
        $attendant = Attendant::all()->find($id);
        return view('admin.attendant.edit', ['attendant' => $attendant, 'students'=> $students]);
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
            'attendant' => 'required|in:Yes,No', 
    
        ]);
        $attendant = Attendant::find($id);
        $attendant->student_id = $request->student_name;
        $attendant->attendant = $request->attendant;
        $attendant->tran_date = (new DateTime);
        $attendant->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $attendant->save();
        return redirect()->route('attendant.index')->with('success', 'Attendant has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Attendant::findOrFail($id);
        $data->delete();
    }
}
