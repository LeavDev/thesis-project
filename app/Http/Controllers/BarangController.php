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
        if (request()->ajax()) {
            $barang = $this->firebase->getAll() ?? [];
            return datatables()->of($barang)
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.barang.index');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $barang = $this->firebase->create($data);
        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $barang = $this->firebase->update($id, $data);
        return response()->json($barang);
    }

    public function destroy(Request $request)
    {
        $this->firebase->delete($request->id);
        return response()->json(['success' => true]);
    }
}
