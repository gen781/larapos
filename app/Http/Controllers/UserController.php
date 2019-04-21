<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->get();
        $response = [
            'status' => 'Sukses',
            'pesan' => 'Daftar User',
            'users' => $users
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('role')->where('id',$id)->firstOrFail();
        $user->view_users = [
            'href' => '/api/user',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi User',
            'user' => $user
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cari($nama)
    {
        $user = User::with('role')->where('name', 'ILIKE', "%{$nama}%")->get();
        $user->view_users = [
            'href' => '/api/user',
            'method' => 'GET'
        ];

        $response = [
            'status' => 'Sukses',
            'pesan' => 'Informasi User',
            'user' => $user
        ];
        return response()->json($response, 200);
    }
}
