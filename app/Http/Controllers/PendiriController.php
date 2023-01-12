<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendiri;

class PendiriController extends Controller
{

    public function index()
    {
        $data_pendiri = Pendiri::all();

        return view('pendiri.index', compact('data_pendiri'));
    }

    public function tambah()
    {
        return view('pendiri.create');
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Nama'         => 'required|min:3',
            'Jenkel'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'Nama.required'        => 'Nama Harus di Isi !',
            'Nama.min'             => 'Nama Minimal 3 Karakter !',

            'Jenkel.required'        => 'Jenis Kelamin Harus di Isi !',
            'Jenkel.min'             => 'Jenis Kelamin Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = new Pendiri();
        $data_to_save->Nama         = $request->Nama;
        $data_to_save->Jenkel       = $request->Jenkel;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_pendiri = Pendiri::findOrFail($id);

        return view('pendiri.detail', compact('detail_pendiri'));
    }

    public function hapus($id)
    {
        $detail_pendiri = Pendiri::findOrFail($id);

        if ($detail_pendiri->baju()->exists()) {
            return back()->with('status', 'Tidak dapat dihapus karena data ber-relasi !');
        }

        $detail_pendiri->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_pendiri = Pendiri::findOrFail($id);

        return view('pendiri.edit', compact('detail_pendiri'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Nama'         => 'required|min:3',
            'Jenkel'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'Nama.required'        => 'Nama Harus di Isi !',
            'Nama.min'             => 'Nama Minimal 3 Karakter !',

            'Jenkel.required'        => 'Jenis Kelamin Harus di Isi !',
            'Jenkel.min'             => 'Jenis Kelamin Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = Pendiri::findOrFail($id);
        $data_to_save->Nama         = $request->Nama;
        $data_to_save->Jenkel       = $request->Jenkel;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }
}
