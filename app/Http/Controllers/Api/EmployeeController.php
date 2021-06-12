<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|string|unique:users,email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'salary' => 'required|string',
            'date_joined' => 'required|date',
            'nid' => 'string'
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employees/gallery/';
            $image_url = $upload_path.$name;

            $image->save($image_url);

            $employee = Employee::create([
                'name' => $fields['name'],
                'username' => $fields['username'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'salary' => $fields['salary'],
                'date_joined' => $fields['date_joined'],
                'nid' => $fields['nid'],
                'photo' => $image_url,
            ]);
            return $employee;
            
        } else {
            $employee = Employee::create([
                'name' => $fields['name'],
                'username' => $fields['username'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'salary' => $fields['salary'],
                'date_joined' => $fields['date_joined'],
                'nid' => $fields['nid'],
            ]);return $employee;
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
