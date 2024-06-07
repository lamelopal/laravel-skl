<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\user;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toko = Toko::all() ;
        $user = User::all() ;
        return view('toko.index', compact('toko','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validasi = Validator::make($input,[
            'nama_toko' => 'required|max:128|string|min:4',
            'desc_toko' => 'required|max:200',
            'kategori_toko' =>'required',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_libur' => 'required',
            'icon_toko' => 'required|mimes:jpeg, jpg, png ,svg',
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        // Input untuk hari
// input toko
        if ($request->hasFile('icon_toko'))
        {
            $folder = 'public/images/toko'; //membuat folder penyimpanan file
            $gambar = $request->file('icon_toko'); //mengambil data dari request foto_profile
            $nama_gambar = $gambar->getClientOriginalName(); //memberikan nama pada file yang diupload.
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar); //mengirimkan gambar ke folder
            $input['icon_toko'] = $nama_gambar; //memberikan nama yang dikirimkan ke database 
        }

        // konversi nilai arry ke dalam string:
        $hari = implode(',', $request->input('hari_buka'));
        $input['hari_buka'] = $hari;


        Toko::create($input);
        return back();

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Toko::find($id);
        return view('toko.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $update = Toko::find($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'nama_toko' => 'required|max:128|string|min:4',
            'desc_toko' => 'required|max:200',
            'kategori_toko' =>'required',
            'hari_buka' => 'required',
            'jam_buka' => 'required',
            'jam_libur' => 'required',
            'icon_toko' => 'required|',
        ]);
        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        // Input untuk hari
// input toko
        if ($request->hasFile('icon_toko'))
        {
            $folder = 'public/images/toko'; //membuat folder penyimpanan file
            $gambar = $request->file('icon_toko'); //mengambil data dari request foto_profile
            $nama_gambar = $gambar->getClientOriginalName(); //memberikan nama pada file yang diupload.
            $path = $request->file('icon_toko')->storeAs($folder, $nama_gambar); //mengirimkan gambar ke folder
            $update['icon_toko'] = $nama_gambar; //memberikan nama yang dikirimkan ke database 
        }

        $update->update($data);
     return redirect ('/toko');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  User::find($id);
        $data -> delete();
        return back ();
        
    }
}