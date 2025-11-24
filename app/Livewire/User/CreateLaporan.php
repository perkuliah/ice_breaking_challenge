<?php

namespace App\Livewire\User;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLaporan extends Component
{
    use WithFileUploads;

    public $judul;
    public $deskripsi;
    public $tanggal;
    public $gambar;

    protected $rules = [
        'judul' => 'required',
        'deskripsi' => 'required',
        'tanggal' => 'required|date',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    public function save()
    {
        $this->validate();

        // Simpan laporan ke database
        if($this->gambar) {
            $this->gambar->storeAs('public/laporan', $this->gambar->hashName());
            $gambarname = $this->gambar->hashName();
        }

        Laporan::create([
            'user_id' => Auth::user()->id,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'gambar' => $gambarname,
            'respon' => '',
        ]);

        $this->reset();

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Laporan berhasil disimpan',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        JS);

        return $this->redirect(route('user.laporan'), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.user.create-laporan');
    }
}
