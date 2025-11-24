<?php

namespace App\Livewire\User;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class LaporanUser extends Component
{
    public $search = '';

    public function deleteConfirm($id, $judul)
    {
        $this->js(<<<JS
            Swal.fire({
                title : "Hapus $judul ?",
                text : "Laporan ini akan dihapus",
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#3085d6',
                cancelButtonColor : '#d33', 
                confirmButtonText : 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    \$wire.delete($id);
                }
            });
        JS);
    }

    public function delete($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        if($laporan->user_id == Auth::user()->id) {

            $gambarName = basename($laporan->getOriginal('gambar'));

            if($gambarName && Storage::exists('public/laporan/'.$gambarName)) {
                Storage::delete('public/laporan/'.$gambarName);
            }

            $laporan->delete();   
            
            $this->js(<<<JS
                Swal.fire({
                    icon: 'success',
                    title: 'Laporan berhasil dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
            JS);

        } else {

            $this->js(<<<JS
                Swal.fire({
                    icon: 'error',
                    title: 'Laporan ini bukan milik anda',
                    showConfirmButton: false,
                    timer: 1500
                });
            JS);
            
        }
    }

    public function render()
    {
        $laporans = Laporan::query();

        if(Auth::user()->role == 'user') {
            $laporans->where('user_id', Auth::user()->id);
        }

        if(!empty($this->search)) {
            // $laporans->where('judul', 'like', '%' . $this->search . '%');
            $laporans->where(function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%'); 
            });
        }

        return view('livewire.user.laporan-user',[
            'laporans' => $laporans->orderBy('id', 'desc')->get()
        ]);
    }
}
