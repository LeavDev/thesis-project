<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $barang = $this->firebase->getAll() ?? [];
        return view('pages.barang.index', compact('barang'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->firebase->create($data);
        return redirect()->back()->with('success', 'Data added successfully');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->firebase->update($id, $data);
        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function destroy($id)
    {
        $this->firebase->delete($id);
        return redirect()->back()->with('success', 'Data deleted successfully');
    }
}
