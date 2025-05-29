<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Criterion::all();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        if (Criterion::count() >= 5) {
            return redirect()->route('kriteria.index')->with('error', 'Maksimal hanya 5 kriteria yang diperbolehkan.');
        }

        $request->validate([
            'name' => 'required',
            'weight' => 'required|numeric|min:0.01|max:1',
            'type' => 'required|in:cost,benefit',
        ]);

        $exists = Criterion::where('name', $request->name)->exists();
        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Kriteria dengan nama yang sama sudah ada.'
            ]);
        }

        $totalWeight = Criterion::sum('weight') + $request->weight;
        if ($totalWeight > 1) {
            return redirect()->route('kriteria.index')->with('error', 'Total bobot tidak boleh melebihi 1.');
        }

        Criterion::create($request->only(['name', 'weight', 'type']));
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kriteria = Criterion::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required|numeric|min:0.01|max:1',
            'type' => 'required|in:cost,benefit',
        ]);

        $kriteria = Criterion::findOrFail($id);
        $exists = Criterion::where('id', '!=', $id)
            ->where('name', $request->name)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors([
                'duplicate' => 'Kriteria dengan nama tersebut sudah ada.'
            ]);
        }

        $totalWeight = (Criterion::sum('weight') - $kriteria->weight) + $request->weight;
        if ($totalWeight > 1) {
            return redirect()->route('kriteria.index')->with('error', 'Total bobot tidak boleh melebihi 1.');
        }

        $kriteria->update($request->only(['name', 'weight', 'type']));
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kriteria = Criterion::findOrFail($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
