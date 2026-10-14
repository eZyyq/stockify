<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'address' => 'nullable',
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }
    public function edit(Supplier $supplier)
{
    return view('suppliers.edit', compact('supplier'));
}

public function update(Request $request, Supplier $supplier)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'nullable',
        'email' => 'nullable|email',
        'address' => 'nullable',
    ]);

    $supplier->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
    ]);

    return redirect()
        ->route('suppliers.index')
        ->with('success', 'Supplier berhasil diperbarui.');
}
public function destroy(Supplier $supplier)
{
    $supplier->delete();

    return redirect()
        ->route('suppliers.index')
        ->with('success', 'Supplier berhasil dihapus.');
}
}