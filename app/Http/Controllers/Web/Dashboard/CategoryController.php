<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('pages.dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.dashboard.category._partials.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('categories', $filename, 'public');
            $validated['image'] = url('storage/categories/' . $filename);
        }

        Categories::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('pages.dashboard.category._partials.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image',
        ]);
        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('categories', $filename, 'public');
            $validated['image'] = url('storage/categories/' . $filename);
        }
        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
