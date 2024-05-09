<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  function __construct(){
        $this->middleware('coba');

        // jika kita ingin mengaktifkan middleware untuk method tertentu saja
        // $this->middleware('coba')->only('daftarMahasiswa');

        // Jika kita ingin menambah method lain, bisa ditulis sebagai berikut:
        // $this->middleware('coba')->only('daftarMahasiswa','tabelMahasiswa');
    }

    public function index()
    {
        //
    }

    public function daftarMahasiswa(){
        return 'Form pendaftaran mahasiswa';
    }

    public function tabelMahasiswa(){
        return 'Tabel data mahasiswa';
    }

    public function blogMahasiswa(){
        return 'Halaman blog mahasiswa';
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
