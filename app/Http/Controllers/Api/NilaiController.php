<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // GET /api/nilai
    public function index(Request $request)
    {
        $query = Nilai::query();

        // Filter berdasarkan keterangan
        if ($request->has('keterangan')) {
            $query->where(
                'keterangan',
                $request->keterangan
            );
        }

        $data = $query->get();

        return response()->json([
            'status' => 'success',
            'total' => $data->count(),
            'data' => $data
        ]);
    }

    // GET /api/nilai/{id}
    public function show($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $nilai
        ]);
    }

    // POST /api/nilai
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'digits:8'
            ],
            'nama' => [
                'required',
                'string'
            ],
            'mata_kuliah' => [
                'required',
                'string'
            ],
            'nilai' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ]
        ]);

        $nilaiAngka = $validated['nilai'];

        // Tentukan keterangan
        $keterangan = $nilaiAngka >= 60
            ? 'Lulus'
            : 'Tidak Lulus';

        // Tentukan grade
        if ($nilaiAngka >= 90) {
            $grade = 'A';
        } elseif ($nilaiAngka >= 80) {
            $grade = 'B';
        } elseif ($nilaiAngka >= 70) {
            $grade = 'C';
        } elseif ($nilaiAngka >= 60) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        $nilai = Nilai::create([
            'nim' => $validated['nim'],
            'nama' => $validated['nama'],
            'mata_kuliah' => $validated['mata_kuliah'],
            'nilai' => $nilaiAngka,
            'keterangan' => $keterangan,
            'grade' => $grade
        ]);

        return response()->json([
            'status' => 'success',
            'pesan' => 'Data berhasil disimpan',
            'data' => $nilai
        ], 201);
    }
}