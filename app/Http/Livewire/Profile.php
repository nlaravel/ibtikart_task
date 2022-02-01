<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Traits\Alert;
class Profile extends Component
{
    use WithFileUploads,Alert;

    public $user=[
        'name'=>'',
        'email'=>'',
        'avatar'=>'',
        'avatar_url'=>'',
    ];

    public $password;
    public $password_tab=false;
    public $avatar;
    public $currentUser ;

    public function mount()
    {
        $this->user=[
            'name'=>auth()->user()->name,
            'email'=>auth()->user()->email,
            'avatar_url'=>auth()->user()->avatarUrl()
        ];

        $this->currentUser = auth()->user();
    }

    public function render()
    {

        return view('dashboard.profile',[ 'user'=>$this->user ])->extends('dashboard_layout.main');

    }
    public function save(){


        $this->validate([
            'user.email' => 'required|email|unique:users,email,'.auth()->id(),
            'user.name' => 'required',
            ]
        );

        $filename = $this->avatar?$this->avatar->store('/','avatars'):$this->currentUser->avatar;

        $user = User::find(auth()->id());
        $user->email = $this->user['email'];
        $user->name = $this->user['name'];
        $user->avatar = $filename;
        if($this->password){
            $user->password=Hash::make($this->password);
        }
        $user->save();


        $this->showModal(\Lang::get('lang.saved_done'),\Lang::get('lang.saved_changed'),'success');
    }


}
