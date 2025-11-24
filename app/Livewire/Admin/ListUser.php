<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListUser extends Component
{
    public $search;

    public function resetPassword($id, $name)
    {
        $this->js(<<<JS
            Swal.fire({
                title : "Reset Password $name ?",
                text : "Password akan di reset menjadi abcd1234",
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#3085d6',
                cancelButtonColor : '#d33', 
                confirmButtonText : 'Reset'
            }).then((result) => {
                if (result.isConfirmed) {
                    \$wire.resetDefault($id);
                }
            });
        JS);
    }

    public function resetDefault($id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt('abcd1234');
        $user->save();
        
        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Password berhasil direset',
                showConfirmButton: false,
                timer: 1500
            });
        JS);
    }

    public function render()
    {
        $users = User::query()->withCount('laporans')->where('role', 'user');

        // if(Auth::user()->role == 'admin') {
        //     $users->where('role', '!=', 'admin');
        // }

        if(!empty($this->search)) {
            $users->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('whatsapp', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.list-user',[
            'users' => $users->get()
        ]);
    }

    // Hash : 1234 => jkdsghfasryuqye58dh
    // 1. Dia ga bisa di kembalikan ke kata aslinya
    // 2. Logika loginnya 1234 => jkdsghfasryuqye58dh 

    // Encrypt : 1234 => fghjhkjlgj
    // 1. Dia bisa di kembalikan ke kata aslinya (decrypt)
    // 2. Logika loginnya fghjhkjlgj => 1234 
}
