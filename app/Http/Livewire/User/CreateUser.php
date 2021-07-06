<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $is_admin;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password],
        ];
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }

    public function back()
    {
        return redirect()->to('/users');
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'address' => $this->address,
            'is_admin' => $this->is_admin,
        ]);

        return redirect()->to('/users');
    }
}
