<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
            $queryString = $request->queryString;
            $users = User::when($queryString != null, function($query) use ($queryString){
                return $query
                        ->where('first_name', 'like', '%'.$queryString.'%')
                        ->orWhere('last_name', 'like', '%'.$queryString.'%')
                        ->orWhere('gender', 'like', '%'.$queryString.'%');
            })->paginate(5);
            return view('admin.user.index', ['users' => $users, 'queryString' => $queryString ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.user.create', ['users' => $users]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email'     => 'required|string|email|max:255|unique:users',
            'gender' => 'required|not_in:0|in:Male,Female', 
            'phone_number' => 'required',
            'address' => 'required',
            'role' => 'required|not_in:0|in:Admin,Teacher,Student',

        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make("123");
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $user->save();
        return redirect()->route('user.index')->with('success', 'User has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::all()->find($id);
        // return view('admin.user.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::all()->find($id);
        return view('admin.user.edit', ['user' => $user]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            //'email'     => 'required|string|email|max:255|unique:users',
            'gender' => 'required|not_in:0|in:Male,Female', 
            'phone_number' => 'required',
            'address' => 'required',
            'role' => 'required|not_in:0|in:Admin,Teacher,Student',

        ]);
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        //$user->email = $request->email;
        //$user->password = Hash::make("123");
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->created_by = auth()->user()->first_name.' '.auth()->user()->last_name;
        $user->save();
        return redirect()->route('user.index')->with('success', 'User has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }
}
