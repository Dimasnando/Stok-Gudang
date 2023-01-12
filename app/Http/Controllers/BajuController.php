<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Baju;
use App\Models\Pendiri;

class BajuController extends Controller
{
    public function index(Request $request)
    {

        // Variable Pencarian
        $cari_Merk = $request->cari_Merk;
        $cari_Nama_pendiri = $request->cari_Nama_pendiri;

        $tipe_sort = 'desc';
        $var_sort = 'created_at';

        // Prepare Model
        $data_baju = Baju::query();

        // Kondisi Pencarian
        if ($request->filled('cari_Merk')) {
            $data_baju = $data_baju->where('Merk', 'LIKE', '%' . $cari_Merk . '%');
        }

        if ($request->filled('cari_Nama_pendiri')) {
            $data_baju = $data_baju->whereHas('pendiri', function (Builder $query) use ($cari_Nama_pendiri) {
                $query->where('Nama', 'LIKE', '%' . $cari_Nama_pendiri . '%');
            });
        }

        // Kondisi Sorting
        if ($request->has('tipe_sort') || $request->has('var_sort')) {
            $tipe_sort = $request->tipe_sort;
            $var_sort = $request->var_sort;

            $data_baju = $data_baju->orderBy($var_sort, $tipe_sort);
        }

        // Kondisi Paginate

        $set_pagination = $request->set_pagination;

        if ($request->filled('set_pagination')) {
            $data_baju = $data_baju
                ->orderBy($var_sort, $tipe_sort)
                ->paginate($set_pagination);
        } else {
            $data_baju = $data_baju
                ->orderBy($var_sort, $tipe_sort)
                ->paginate(5);
        }

        // Append Query String to Pagination
        $data_baju = $data_baju->withQueryString();


        // Return View dengan Data
        return view('baju.index', compact(
            'data_baju',
            'cari_Merk',
            'cari_Nama_pendiri',

            'tipe_sort',
            'var_sort',

            'set_pagination'
        ));
    }

    public function tambah()
    {
        $data_pendiri = Pendiri::all();

        return view('baju.create', compact('data_pendiri'));
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Merk'         => 'required',
            'Ukuran'         => 'required',
            'Jumlah'      => 'required|numeric',
            'pendiri_ke'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'Merk.required'        => 'Merk Harus di Isi !',

            'Ukuran.required'        => 'Ukuran Harus di Isi !',


            'Jumlah.required'     => 'Jumlah Harus di Isi',
            'Jumlah.numeric'      => 'Jumlah Harus Berupa Angka',
            'pendiri_ke.required'  => 'Pendiri Harus di Isi',

        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = new Baju();
        $data_to_save->Merk         = $request->Merk;
        $data_to_save->Ukuran       = $request->Ukuran;
        $data_to_save->Jumlah       = $request->Jumlah;
        $data_to_save->pendiri_id  = $request->pendiri_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_baju = Baju::findOrFail($id);

        return view('baju.detail', compact('detail_baju'));
    }

    public function hapus($id)
    {
        $detail_baju = Baju::findOrFail($id);

        $detail_baju->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_baju = Baju::findOrFail($id);
        $data_pendiri = Pendiri::all();

        return view('baju.edit', compact('detail_baju', 'data_pendiri'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Merk'           => 'required',
            'Ukuran'         => 'required',
            'Jumlah'         => 'required|numeric',
            'pendiri_ke'     => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'Merk.required'        => 'Merk Harus di Isi !',

            'Ukuran.required'      => 'Ukuran Harus di Isi !',

            'Jumlah.required'      => 'Jumlah Harus di Isi',
            'Jumlah.numeric'       => 'Jumlah Harus Berupa Angka',
            'pendiri_ke.required'  => 'Pendiri Harus di Isi',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = Baju::findOrFail($id);
        $data_to_save->Merk         = $request->Merk;
        $data_to_save->Ukuran       = $request->Ukuran;
        $data_to_save->Jumlah       = $request->Jumlah;
        $data_to_save->pendiri_id   = $request->pendiri_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Update Data Berhasil !');
    }
}
