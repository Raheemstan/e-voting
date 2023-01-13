<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Voter extends Component
{
    public $showTable = true;
    public $showCreate = false;
    public $showUpdate = false;
    public $groupUpload = false;
    public $total;

    public $name;
    public $email;
    public $password;

    public $search;

    public $voter_id;
    public $edit_name;
    public $edit_email;

    public function render()
    {
        if ($this->search != "") {
            $voters = User::orderBy('id', 'DESC')
            ->where('vote_id', 'LIKE', '%' . $this->search . '%')
            ->get();
            return view('livewire.admin.voter', compact('voters'))->layout('layout.admin-app');
        }
        $this->total = User::count();
        $voters = User::orderBy('id', 'DESC')->get();
        return view('livewire.admin.voter', compact('voters'))->layout('layout.admin-app');
    }

    public function goBack()
    {
        $this->showTable = true;
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->groupUpload = false;
    }


    public function showForm()
    {
        $this->showTable = false;
        $this->groupUpload = false;
        $this->showCreate = true;
    }
    use WithFileUploads;

    public function resetField()
    {
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->voter_id = "";
        $this->edit_name = "";
        $this->edit_email = "";
    }

    // genereta random id;

    public function generete($length)
    {
        $char = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $char_lenght = strlen($char);
        $str = "";

        for ($i = 0; $i < $length; $i++) {
            $str .= $char[rand(0, $char_lenght - 1)];
        }
        return $str;
    }

    public function groupUpload()
    {
        
        $this->showTable = false;
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->groupUpload = true;
        
    }    

    public function uploadFile()
    {
        $voters = new User();
        $this->validate([
            'image' => ['required']
        ]);
        $filename = "";
        if ($this->image != "") {
            $filename = $this->image->store('csv', 'public');
        } else {
            $filename = "null";
        }

        $voters->name = $this->name;
        $voters->lname = $this->lname;
        $voters->email = $this->email;
        $voters->pos_id = $this->pos_id;
        $voters->image = $filename;
        $voters->points = 1;
        $result = $voters->save();
        if ($result) {
            session()->flash('success', "Voter Add Successfully");
            $this->resetField();
            $this->goBack();
        } else {
            session()->flash('error', "Voters Not Add Successfully");
        }
    }

    public function create()
    {
        $users = new User();
        $this->validate([
            'name' => ['string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required'],
        ]);
        $users->name = $this->name;
        $users->email = $this->email;
        $users->password = Hash::make($this->password);
        $users->vote_id = $this->password;
        $result = $users->save();
        if ($result) {
            session()->flash('success', 'Voter Add Successfully');
            $this->goBack();
            $this->resetField();
        }
    }

    public function edit($id)
    {
        $this->showTable = false;
        $this->groupUpload = false;
        $this->showUpdate = true;
        $voters = User::findOrFail($id);
        $this->voter_id = $voters->id;
        $this->edit_name = $voters->name;
        $this->edit_email = $voters->email;
    }

    public function update($id)
    {
        $voters = User::findOrFail($id);
        $this->validate([
            'edit_name' => ['string'],
            'edit_email' => ['required', 'string', 'email'],
        ]);

        $voters->name = $this->edit_name;
        $voters->email = $this->edit_email;
        $result = $voters->save();
        if ($result) {
            session()->flash('success', 'Voter Update Successfully');
            $this->goBack();
            $this->resetField();
        }
    }
    public function delete($id)
    {
        $candidates = User::findOrFail($id);
        $result = $candidates->delete();
        if ($result) {
            session()->flash('success', "Voter Delete Successfully");
        } else {
            session()->flash('error', "Voter Not Delete Successfully");
        }
    }
}
