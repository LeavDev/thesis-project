<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BarangController extends Controller
{
    protected $firebase;
    protected $perPage = 5;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index(Request $request)
    {
        $allBarang = $this->firebase->getAll() ?? [];

        // pagination
        $currentPage = $request->get('page', 1);
        $items = collect($allBarang);

        $paginatedData = new LengthAwarePaginator(
            $items->forPage($currentPage, $this->perPage),
            $items->count(),
            $this->perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('pages.barang.index', ['barang' => $paginatedData]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'model' => 'required',
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
            'model' => 'required',
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
