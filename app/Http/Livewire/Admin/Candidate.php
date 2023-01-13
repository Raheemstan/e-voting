<?php

namespace App\Http\Livewire\Admin;

use App\Models\Candidate as ModelsCandidate;
use App\Models\Position;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Candidate extends Component
{
    public $showTable = true;
    public $showCreate = false;
    public $showUpdate = false;
    public $total;
    public $fname;
    public $lname;
    public $email;
    public $image;
    public $pos_id;
    public $positions;

    public $candidate_id;
    public $edit_fname;
    public $edit_lname;
    public $edit_email;
    public $old_image;
    public $new_image;
    public $edit_pos_id;

    public $search;
    public function render()
    {
        $this->total = ModelsCandidate::count();
        if ($this->search != "") {
            $candidates = ModelsCandidate::orderBy('id', 'DESC')->where('email', 'LIKE', '%' . $this->search . '%')->get();
            return view('livewire.admin.candidate', compact('candidates'))->layout('layout.admin-app');
        }
        $this->positions = Position::all();
        $candidates = ModelsCandidate::orderBy('id', 'DESC')->get();
        return view('livewire.admin.condidate', compact('candidates'))->layout('layout.admin-app');
    }

    public function goBack()
    {
        $this->showTable = true;
        $this->showCreate = false;
        $this->showUpdate = false;
    }
    public function showForm()
    {
        $this->showTable = false;
        $this->showCreate = true;
    }

    public function resetField()
    {
        $this->fname = "";
        $this->lname = "";
        $this->email = "";
        $this->image = "";
        $this->pos_id = "";

        $this->candidate_id = "";
        $this->edit_fname = "";
        $this->edit_lname = "";
        $this->edit_email = "";
        $this->old_image = "";
        $this->new_image = "";
        $this->edit_pos_id = "";
    }

    use WithFileUploads;
    public function store()
    {
        $candidates = new ModelsCandidate();
        $this->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'email' => ['required', 'string'],
            'pos_id' => ['required', 'string'],
            'image' => ['required']
        ]);
        $filename = "";
        if ($this->image != "") {
            $filename = $this->image->store('candidate', 'public');
        } else {
            $filename = "null";
        }
        $candidates->fname = $this->fname;
        $candidates->lname = $this->lname;
        $candidates->email = $this->email;
        $candidates->pos_id = $this->pos_id;
        $candidates->image = $filename;
        $candidates->points = 1;
        $result = $candidates->save();
        if ($result) {
            session()->flash('success', "Candidates Add Successfully");
            $this->resetField();
            $this->goBack();
        } else {
            session()->flash('error', "Candidates Not Add Successfully");
        }
    }

    public function edit($id)
    {
        $this->showTable = false;
        $this->showUpdate = true;
        $candidates = ModelsCandidate::findOrFail($id);
        $this->candidate_id = $candidates->id;
        $this->edit_fname = $candidates->fname;
        $this->edit_lname = $candidates->lname;
        $this->edit_email = $candidates->email;
        $this->old_image = $candidates->image;
        $this->edit_pos_id = $candidates->pos_id;
    }

    public function update($id)
    {
        $candidates = ModelsCandidate::findOrFail($id);
        $this->validate([
            'edit_fname' => ['required', 'string'],
            'edit_lname' => ['required', 'string'],
            'edit_email' => ['required', 'string'],
            'edit_pos_id' => ['required', 'string'],
        ]);
        $filename = "";
        $destination = public_path("storage\\" . $candidates->image);

        if ($this->new_image != "") {
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $filename = $this->new_image->store('candidate', 'public');
        } else {
            $filename = $this->old_image;
        }
        $candidates->fname = $this->edit_fname;
        $candidates->lname = $this->edit_lname;
        $candidates->email = $this->edit_email;
        $candidates->pos_id = $this->edit_pos_id;
        $candidates->image = $filename;
        $result = $candidates->save();
        if ($result) {
            session()->flash('success', "Candidates Update Successfully");
            $this->resetField();
            $this->goBack();
        } else {
            session()->flash('error', "Candidates Not Update Successfully");
        }
    }

    public function delete($id)
    {
        $candidates = ModelsCandidate::findOrFail($id);
        $destination = public_path("storage\\" . $candidates->image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $result = $candidates->delete();
        if ($result) {
            session()->flash('success', "Candidates Delete Successfully");
        } else {
            session()->flash('error', "Candidates Not Delete Successfully");
        }
    }
}
