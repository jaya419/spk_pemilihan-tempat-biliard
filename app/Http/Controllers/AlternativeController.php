<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index(Request $request)
    {
        $query = Alternative::query();

        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%");
        }

        $alternatives = $query->get();
        return view('alternative.index', compact('alternatives'));
    }

    public function create()
    {
        return view('alternative.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:alternatives,name',
            'address' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'open_hour' => 'nullable|date_format:H:i',
            'close_hour' => 'nullable|date_format:H:i',
        ]);

        $exists = Alternative::where('name', $request->name)->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Tempat billiard dengan nama tersebut sudah ada.'
            ]);
        }

        Alternative::create($request->only([
            'name', 'address', 'contact', 'description', 'open_hour', 'close_hour'
        ]));

        return redirect()->route('alternative.index')->with('success', 'Tempat billiard berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alternative = Alternative::findOrFail($id);
        return view('alternative.edit', compact('alternative'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:alternatives,name,' . $id,
            'address' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'open_hour' => 'nullable|date_format:H:i',
            'close_hour' => 'nullable|date_format:H:i',
        ]);

        $alternative = Alternative::findOrFail($id);

        $exists = Alternative::where('id', '!=', $id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Tempat billiard dengan nama tersebut sudah ada.'
            ]);
        }

        $alternative->update($request->only([
            'name', 'address', 'contact', 'description', 'open_hour', 'close_hour'
        ]));

        return redirect()->route('alternative.index')->with('success', 'Tempat billiard berhasil diupdate.');
    }

    public function destroy($id)
    {
        $alternative = Alternative::findOrFail($id);
        $alternative->delete();

        return redirect()->route('alternative.index')->with('success', 'Tempat billiard berhasil dihapus.');
    }
}
