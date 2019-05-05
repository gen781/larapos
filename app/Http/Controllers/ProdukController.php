<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::with('satuan')->get();
        $response = [
            'status' => 'Sukses',
            'pesan' => 'Daftar Produk',
            'produks' => $produks
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
        $kode_produk = $request->input('kode_produk');
        $nama = $request->input('nama');
        $satuan = $request->input('satuan');
        $harga_beli = $request->input('harga_beli');
        $harga_jual = $request->input('harga_jual');
        $harga_jual = $request->input('harga_jual');
        $stok = $request->input('stok');
  
        $produk = new Produk([
            'kode_produk' => $kode_produk,
            'nama' => $nama,
            'satuan' => $satuan,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual,
            'stok' => $stok,
        ]);
  
        if ($produk->save()) {
            $produk->view_produk = [
                'href' => '/api/produk/' . $produk->id,
                'method' => 'GET'
            ];
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Produk berhasil ditambahkan',
                'produk' => $produk,
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
        $produk = Produk::with('satuan')->where('id',$id)->firstOrFail();
        $produk->view_satuans = [
            'href' => '/api/produk',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Produk',
            'produk' => $produk
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
        $kode_produk = $request->input('kode_produk');
        $nama = $request->input('nama');
        $satuan = $request->input('satuan');
        $harga_beli = $request->input('harga_beli');
        $harga_jual = $request->input('harga_jual');

        $produk = Produk::findOrFail($id);

        $produk->kode_produk = $kode_produk;
        $produk->nama = $nama;
        $produk->satuan = $satuan;
        $produk->harga_beli = $harga_beli;
        $produk->harga_jual = $harga_jual;

        if(!$produk->update()){
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses update gagal'
            ];
            return response()->json($response, 404);
        }

        $produk->view_produk = [
            'href' => '/api/produk/' . $produk->id,
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Update produk berhasil',
            'produk' => $produk
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
        $produk = Produk::findOrFail($id);

        if($produk->delete()){
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Produk berhasil dihapus',
                'create' => [
                'href' => '/api/produk',
                'method' => 'POST',
                'params' => 'kode_produk, nama, satuan, harga_beli, harga_jual, stok'
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

    public function cari($cari)
    {
        $produk = Produk::with('satuan')->where('nama', 'ILIKE', "%{$cari}%")->orWhere('kode_produk', 'ILIKE', "%{$cari}%")->get();
        $produk->view_produks = [
            'href' => '/api/produk',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Produk',
            'produk' => $produk
        ];
        return response()->json($response, 200);
    }
}
