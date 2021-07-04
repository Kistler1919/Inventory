<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('suppliers', 'products.supplier_id', 'suppliers.id')
                    ->select('categories.name as category_name', 'suppliers.name as supplier_name', 'products.*')
                    ->orderBy('products.id', 'desc')
                    ->get();
        return response()->json($products);
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
            'code' => 'required|unique:products,code|max:255',
            'purchase_price' => 'required|string',
            'retail_price' => 'required|string',
            'wholesale_price' => 'required|string',
            'quantity' => 'required|string',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'purchase_date' => 'required|date',
            'root' => 'required|string',
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $img = Image::make($request->image)->resize(240, 200);
            $upload_path = 'backend/products/gallery/';
            $image_url = $upload_path.$name;

            $img->save($image_url);

            $product = Product::create([
                'name' => $fields['name'],
                'code' => $fields['code'],
                'root' => $fields['root'],
                'quantity' => $fields['quantity'],
                'category_id' => $fields['category_id'],
                'supplier_id' => $fields['supplier_id'],
                'purchase_date' => $fields['purchase_date'],
                'purchase_price' => $fields['purchase_price'],
                'retail_price' => $fields['retail_price'],
                'wholesale_price' => $fields['wholesale_price'],
                'image' => $image_url,
            ]);
            return $product;
            
        } else {
            $product = Product::create([
                'name' => $fields['name'],
                'code' => $fields['code'],
                'root' => $fields['root'],
                'quantity' => $fields['quantity'],
                'category_id' => $fields['category_id'],
                'supplier_id' => $fields['supplier_id'],
                'purchase_date' => $fields['purchase_date'],
                'purchase_price' => $fields['purchase_price'],
                'retail_price' => $fields['retail_price'],
                'wholesale_price' => $fields['wholesale_price'],
            ]);
            return $product;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['code'] = $request->code;
        $data['root'] = $request->root;
        $data['purchase_price'] = $request->purchase_price;
        $data['retail_price'] = $request->retail_price;
        $data['wholesale_price'] = $request->wholesale_price;
        $data['purchase_date'] = $request->purchase_date;
        $data['quantity'] = $request->quantity;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;

        $photo = $request->new_image;

        if ($photo) {
            $position = strpos($photo, ';');
            $sub = substr($photo, 0, $position);
            $exist = explode('/', $sub)[1];


            $name = time().".".$exist;
            $image = Image::make($photo)->resize(240, 200);
            $upload_path = 'backend/employees/gallery/';
            $image_url = $upload_path.$name;

            $success = $image->save($image_url);

            if ($success) {
                $data['image'] = $image_url;
                $img = Product::where('id', $id)->first();
                $image_path = $img->image;
                unlink($image_path);
                $product = Product::where('id', $id)->update($data);
            }

            return $product;
        } else {
            $oldImage = $request->image;
            $data['image'] = $oldImage;
            $product = Product::where('id', $id)->update($data);
            return $product;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $photo = $product->image;
        if ($photo) {
            unlink($photo);
            Product::where('id', $id)->delete();
        } else {
            Product::where('id', $id)->delete();
        }
    }
}
