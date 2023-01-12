<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

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
        if ($request->filled('cari_judul')) {
            $data_baju = $data_baju->where('judul', 'LIKE', '%' . $cari_Merk . '%');
        }

        if ($request->filled('cari_Nama_pendiri')) {
            $data_baju = $data_baju->whereHas('penerbit', function (Builder $query) use ($cari_Nama_pendiri) {
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


        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Ambil !",
            "data"  => $data_baju
        ], 200);
    }


    public function tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Merk'         => 'required',

            'Ukuran'         => 'required',

            'Jumlah'      => 'required|numeric',
            'pendiri_id'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'Merk.required'        => 'Merk Harus di Isi !',

            'Ukuran.required'        => 'Ukuran Harus di Isi !',

            'Jumlah.required'     => 'Jumlah Harus di Isi',
            'Jumlah.numeric'      => 'Jumlah Harus Berupa Angka',
            'pendiri_id.required'  => 'Pendiri Harus di Isi',

        ];

        // Validasi
        $validator = Validator::make($request->all(), $rule_validasi, $pesan_validasi);

        // Jika Gagal Validasi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Tambah Data !',
                'data'    => $validator->errors(),
            ], 401);
        }

        // Mapping All Request 
        $data_to_save               = new Baju();
        $data_to_save->Merk        = $request->Merk;
        $data_to_save->Ukuran        = $request->Ukuran;
        $data_to_save->Jumlah     = $request->Jumlah;
        $data_to_save->pendiri_id  = $request->pendiri_id;

        // Save to DB
        $data_to_save->save();

        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Tambah !",
            "data"  => $data_to_save
        ], 201);
    }

    public function ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'Merk'         => 'required',

            'Ukuran'         => 'required',

            'Jumlah'      => 'required|numeric',
            'pendiri_id'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'Merk.required'        => 'Merk Harus di Isi !',

            'Ukuran.required'        => 'Ukuran Harus di Isi !',

            'Jumlah.required'     => 'Jumlah Harus di Isi',
            'Jumlah.numeric'      => 'Jumlah Harus Berupa Angka',
            'pendiri_id.required'  => 'Pendiri Harus di Isi',

        ];

        // Validasi
        $validator = Validator::make($request->all(), $rule_validasi, $pesan_validasi);

        // Jika Gagal Validasi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Ubah Data !',
                'data'    => $validator->errors(),
            ], 401);
        }

        // Mapping All Request 
        $data_to_save               = Baju::where('id', $id)->first();

        if (empty($data_to_save)) {
            return response()->json([
                "pesan" => "Data Baju Tidak diTemukan !",
            ], 404);
        }

        $data_to_save->Merk        = $request->Merk;
        $data_to_save->Ukuran        = $request->Ukuran;
        $data_to_save->Jumlah     = $request->Jumlah;
        $data_to_save->pendiri_id  = $request->pendiri_id;

        // Save to DB
        $data_to_save->save();

        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Ubah !",
            "data"  => $data_to_save
        ], 200);
    }

    public function hapus($id)
    {
        $detail_baju = Baju::where('id', $id)->first();

        if (empty($detail_buku)) {
            return response()->json([
                "pesan" => "Data BaJU Tidak diTemukan !",
            ], 404);
        }

        $detail_baju->delete();

        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Hapus !",
        ], 200);
    }
}
