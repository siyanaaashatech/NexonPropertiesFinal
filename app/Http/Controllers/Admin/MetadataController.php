<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Metadata;
use Illuminate\Http\Request;

class MetadataController extends Controller
{
    public function index()
    {
        $metadata = Metadata::all();
        return view('admin.metadata.index', compact('metadata'));
    }

    public function create()
    {
        return view('admin.metadata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:260',
            'meta_keywords' => 'required|string',
            'slug' => 'required|string|max:255|unique:metadata',
        ]);

        Metadata::create($request->all());

        return redirect()->route('metadata.index')->with('success', 'Metadata created successfully.');
    }

    public function edit(Metadata $metadata)
    {
        return view('admin.metadata.update', compact('metadata'));
    }

    public function update(Request $request, $id)
{
    $metadata = Metadata::findOrFail($id);

    $request->validate([
        'meta_title' => 'required|string|max:255',
        'meta_description' => 'required|string',
        'meta_keywords' => 'required|string',
        'slug' => 'required|string|max:255|unique:metadata,slug,' . $metadata->id, 
    ]);

    $metadata->update($request->all());

    return redirect()->route('metadata.index')->with('success', 'Metadata updated successfully!');
}

    public function destroy(Metadata $metadata)
    {
        $metadata->delete();
        return redirect()->route('metadata.index')->with('success', 'Metadata deleted successfully.');
    }
}
