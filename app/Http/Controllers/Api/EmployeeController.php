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
            'username' => 'required|string|unique:employees,username',
            'email' => 'required|email|string|unique:employees,email|max:255',
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
        $employee = Employee::where('id', $id)->first();
        // dd($employee);
        return response()->json($employee);
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
        $data = array();
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['salary'] = $request->salary;
        $data['date_joined'] = $request->date_joined;
        $data['nid'] = $request->nid;
        $data['name'] = $request->name;

        $image = $request->new_profile;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/employees/gallery/';
            $image_url = $upload_path.$name;

            $success = $image->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = Employee::where('id', $id)->first();
                $image_path = $img->photo;
                unlink($image_path);
                $employee = Employee::where('id', $id)->update($data);
            }
            return $employee;
            
        } else {
            $oldProfile = $request->photo;
            $data['photo'] = $oldProfile;
            $employee = Employee::where('id', $id)->update($data);
            return $employee;
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
        $employee = Employee::where('id', $id)->first();
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
            Employee::where('id', $id)->delete();
        } else {
            Employee::where('id', $id)->delete();
        }
    }
}
