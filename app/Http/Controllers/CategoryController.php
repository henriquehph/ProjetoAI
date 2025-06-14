<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::query();
        if ($request->filled('name')) {
            $categories->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('deleted_at') and $request->deleted_at == 1) {
            $categories->whereNotNull('deleted_at');
        } elseif ($request->filled('deleted_at') and $request->deleted_at == 0) {
            $categories->order('deleted_at');
        }

        $categories = $categories->paginate(20)->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category(); // empty category object
        return view('categories.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request)
    {

        $data = $request->validated();

        // Handle photo upload if file is present
        if ($request->hasFile('photo_file')) {
            $path = $request->file('photo_file')->store('photos', 'public');

            //dd($path); // debug
            $data['image'] = $path; // save relative path in 'photo' field
        }

        Category::create($data);

        return redirect()->route('categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, Category $category)
    {

        //dd($request->allFiles());
        $data = $request->validated();
        //dd($data); // debug

        if ($request->hasFile('photo_file')) {
            // Delete old photo if exists
            //dd($request->hasFile('photo_file')); // debug
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            // Store new photo
            $path = $request->file('photo_file')->store('photos', 'public');
            //dd($path); // debug
            $data['image'] = $path;
            //dd($data['photo']); // debug
        }

        if ($request->input('delete_photo') == '1') {
            if ($category->image) {
                //dd($category->photo);
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = null;
        }

        //dd($data); // debug

        $category->update($data);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->deleted_at) {
            $category->deleted_at = null;
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category restored successfully.');
        }
        if ($category->products()->count() == 0) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }

        $category->deleted_at = now();
        $category->save();

        return redirect()->route('categories.index')->with('error', 'Category cannot be fully deleted because it has associated products.');

    }
}
