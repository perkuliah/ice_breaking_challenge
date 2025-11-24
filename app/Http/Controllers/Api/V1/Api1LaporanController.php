<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class Api1LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('user')->get();

        $mapped = $laporan->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->judul,
                'deskripsi' => $item->deskripsi,
                'tanggal'   => $item->tanggal,
                'gambar'    => $item->gambar,
                'status'    => $item->status,
                'respon'    => $item->respon ?? 'Belum ada respon',
                'user'      => [
                'name' => $item->user->name,
                'email' => $item->user->email
                ],
            ];
        });

        return response()->json([
            'message' => 'success',
            'data' => $mapped
        ]);
    }
}
