<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['storeSubcategory']);
    }

    public function subcategories($id) {
        $category = Category::findOrFail($id);

        return $category->subcategories;
    }

    public function storeSubcategory(Request $request) 
    {
        $this->validate($request, [
            'parent_id' => 'required|exists:categories,id',
            'name' => 'required|between:3,15'
        ]);

        $subcategory = Category::create($request->only(['parent_id', 'name']));

        return $subcategory;
    }
}
