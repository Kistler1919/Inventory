<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
            'name' => 'required|string|unique:suppliers,name',
            'email' => 'required|email|string|unique:suppliers,email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'shop' => 'required|string',
            'country' => 'required|string',
        ]);

        if ($request->logo) {
            $position = strpos($request->logo, ';');
            $sub = substr($request->logo, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($request->logo)->resize(240, 200);
            $upload_path = 'backend/suppliers/gallery/';
            $image_url = $upload_path.$name;

            $image->save($image_url);

            $supplier = Supplier::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'country' => $fields['country'],
                'shop' => $fields['shop'],
                'logo' => $image_url,
            ]);
            return $supplier;
            
        } else {
            $supplier = Supplier::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'country' => $fields['country'],
                'shop' => $fields['shop'],
            ]);
            return $supplier;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        return response()->json($supplier);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['shop'] = $request->shop;
        $data['country'] = $request->country;

        $image = $request->new_logo;

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/suppliers/gallery/';
            $image_url = $upload_path.$name;

            $success = $image->save($image_url);

            if ($success) {
                $data['logo'] = $image_url;
                $img = Supplier::where('id', $id)->first();
                $image_path = $img->logo;
                unlink($image_path);
                $supplier = Supplier::where('id', $id)->update($data);
            }
            return $supplier;
            
        } else {
            $oldProfile = $request->logo;
            $data['logo'] = $oldProfile;
            $supplier = Supplier::where('id', $id)->update($data);
            return $supplier;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        $photo = $supplier->photo;
        if ($photo) {
            unlink($photo);
            Supplier::where('id', $id)->delete();
        } else {
            Supplier::where('id', $id)->delete();
        }
    }
}
