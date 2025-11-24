<?php

namespace App\Livewire\Admin;

use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditLaporanAdmin extends Component
{
    use WithFileUploads;

    public $laporanId, $judul, $deskripsi, $tanggal, $gambar, $gambarLama, $status, $respon;

    public function mount($id)
    {

        $laporan            = Laporan::findOrFail($id);
        
        $this->laporanId    = $id;
        $this->judul        = $laporan->judul;
        $this->deskripsi    = $laporan->deskripsi;
        $this->tanggal      = $laporan->tanggal;
        $this->gambarLama   = $laporan->gambar;
        $this->status       = $laporan->status;
        $this->respon       = $laporan->respon;
        
    }

    public function update()
    {
        $this->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal'   => 'required|date',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'    => 'required|in:pending,diproses,selesai',
            'respon'    => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($this->laporanId);

        $laporan->judul     = $this->judul;
        $laporan->deskripsi = $this->deskripsi;
        $laporan->tanggal   = $this->tanggal;
        $laporan->status    = $this->status;
        $laporan->respon    = $this->respon;

        // 🔹 handle upload gambar baru
        if ($this->gambar) {
            
            $gambarName = basename($laporan->getOriginal('gambar'));

            if($gambarName && Storage::exists('public/laporan/'.$gambarName)) {
                Storage::delete('public/laporan/'.$gambarName);
            }

            $filename = $this->gambar->hashName();
            $this->gambar->storeAs('public/laporan', $filename);
            $laporan->gambar = $filename;
        }

        $laporan->save();

        $this->js(<<<'JS'
            Swal.fire({
                title: 'Berhasil!',
                text: 'Laporan berhasil diperbarui',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        JS);

        return $this->redirect(route('admin.laporan'), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.admin.edit-laporan-admin');
    }
}
