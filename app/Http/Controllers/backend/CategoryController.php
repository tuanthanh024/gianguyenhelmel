<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.categories.index');
    }

    public function delete(Request $request)
    {
        Category::find($request->id)->delete();
        return response()->json([
            'message' => 'You don\'t have any categories yet, please click add button to create a new one',
            'empty' => Category::all()->count() == 0
        ]);
    }
}
