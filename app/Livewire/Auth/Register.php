<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public $name, $email, $whatsapp, $password, $password_confirmation;

    public function register()
    {
        $this->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp'              => ['required', 'string', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:1', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'whatsapp' => $this->whatsapp,
            'password' => bcrypt($this->password),
            'username' => $this->name,
        ]);

        // $user = new User();
        // $user->name = $this->name;
        // $user->email = $this->email;
        // $user->whatsapp = $this->whatsapp;
        // $user->password = bcrypt($this->password);
        // $user->save();

        $this->reset();

        $this->js(<<<JS
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Akun berhasil dibuat',
                showConfirmButton: false,
                timer: 3000,
            });
        JS);

        return $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
