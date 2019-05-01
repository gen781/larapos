<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $response = [
            'status' => 'Sukses',
            'pesan' => 'Daftar Supplier',
            'suppliers' => $suppliers
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $telepon = $request->input('telepon');
        $alamat = $request->input('alamat');
  
        $supplier = new Supplier([
            'nama' => $nama,
            'telepon' => $telepon,
            'alamat' => $alamat,
        ]);
  
        if ($supplier->save()) {
            $supplier->view_supplier = [
                'href' => '/api/supplier/' . $supplier->id,
                'method' => 'GET'
            ];
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Supplier berhasil didaftarkan',
                'supplier' => $supplier,
            ];
            return response()->json($response, 201);
        } else {
            $response = [
                'error' => 'Terjadi kesalahan'
            ];
            return response()->json($response, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::where('id',$id)->firstOrFail();
        $supplier->view_suppliers = [
            'href' => '/api/supplier',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Supplier',
            'supplier' => $supplier
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama = $request->input('nama');
        $telepon = $request->input('telepon');
        $alamat = $request->input('alamat');

        $supplier = Supplier::findOrFail($id);

        $supplier->nama = $nama;
        $supplier->telepon = $telepon;
        $supplier->alamat = $alamat;

        if(!$supplier->update()){
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses update gagal'
            ];
            return response()->json($response, 404);
        }

        $supplier->view_supplier = [
            'href' => '/api/supplier/' . $supplier->id,
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Update supplier berhasil',
            'supplier' => $supplier
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if($supplier->delete()){
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Supplier berhasil dihapus',
                'create' => [
                'href' => '/api/supplier',
                'method' => 'POST',
                'params' => 'nama, alamat, telepon'
                ]
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses hapus gagal'
            ];
            return response()->json($response, 404);
        }
    }

    public function cari($nama)
    {
        $supplier = Supplier::where('nama', 'ILIKE', "%{$nama}%")->get();
        $supplier->view_suppliers = [
            'href' => '/api/supplier',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Supplier',
            'supplier' => $supplier
        ];
        return response()->json($response, 200);
    }
}
