<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = DB::table('customers')->orderBy('id', 'desc')->get();
        return response()->json($customers);
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
            'email' => 'email|string|unique:customers,email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|unique:customers',
        ]);

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/customers/gallery/';
            $image_url = $upload_path.$name;

            $image->save($image_url);

            $customer = Customer::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'photo' => $image_url,
            ]);
            return $customer;
            
        } else {
            $customer = Customer::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
            ]);return $customer;
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
        $customer = Customer::where('id', $id)->first();
        // dd($customer);
        return response()->json($customer);
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
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;

        $image = $request->new_profile;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/customers/gallery/';
            $image_url = $upload_path.$name;

            $success = $image->save($image_url);

            if ($success) {
                $data['photo'] = $image_url;
                $img = Customer::where('id', $id)->first();
                $image_path = $img->photo;
                unlink($image_path);
                $customer = Customer::where('id', $id)->update($data);
            }
            return $customer;
            
        } else {
            $oldProfile = $request->photo;
            $data['photo'] = $oldProfile;
            $customer = Customer::where('id', $id)->update($data);
            return $customer;
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
        $customer = Customer::where('id', $id)->first();
        $photo = $customer->photo;
        if ($photo) {
            unlink($photo);
            Customer::where('id', $id)->delete();
        } else {
            Customer::where('id', $id)->delete();
        }
    }
}
