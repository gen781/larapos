<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        $response = [
            'status' => 'Sukses',
            'pesan' => 'Daftar Pelanggan',
            'pelanggans' => $pelanggans
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
        $hp = $request->input('hp');
        $alamat = $request->input('alamat');
  
        $pelanggan = new Pelanggan([
            'nama' => $nama,
            'hp' => $hp,
            'alamat' => $alamat,
        ]);
  
        if ($pelanggan->save()) {
            $pelanggan->view_pelanggan = [
                'href' => '/api/pelanggan/' . $pelanggan->id,
                'method' => 'GET'
            ];
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Pelanggan berhasil didaftarkan',
                'pelanggan' => $pelanggan,
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
        $pelanggan = Pelanggan::where('id',$id)->firstOrFail();
        $pelanggan->view_pelanggans = [
            'href' => '/api/pelanggan',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Pelanggan',
            'pelanggan' => $pelanggan
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
        $hp = $request->input('hp');
        $alamat = $request->input('alamat');

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->nama = $nama;
        $pelanggan->hp = $hp;
        $pelanggan->alamat = $alamat;

        if(!$pelanggan->update()){
            $response = [
                'status' => 'Error',
                'pesan' => 'Proses update gagal'
            ];
            return response()->json($response, 404);
        }

        $pelanggan->view_pelanggan = [
            'href' => '/api/pelanggan/' . $pelanggan->id,
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Update pelanggan berhasil',
            'pelanggan' => $pelanggan
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
        $pelanggan = Pelanggan::findOrFail($id);

        if($pelanggan->delete()){
            $response = [
                'status' => 'Sukses',
                'pesan' => 'Pelanggan berhasil dihapus',
                'create' => [
                'href' => '/api/pelanggan',
                'method' => 'POST',
                'params' => 'nama, alamat, hp'
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
        $pelanggan = Pelanggan::where('nama', 'ILIKE', "%{$nama}%")->get();
        $pelanggan->view_pelanggans = [
            'href' => '/api/pelanggan',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi Pelanggan',
            'pelanggan' => $pelanggan
        ];
        return response()->json($response, 200);
    }
}
