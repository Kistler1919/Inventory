<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);
        $category = Category::create([
            'name' => $field['name']
        ]);

        return response()->json($category);
    }

    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $newCat = array();
        $newCat['name'] = $request->name;
        Category::where('id', $id)->first()->update($newCat);
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first()->delete();
    }
}
