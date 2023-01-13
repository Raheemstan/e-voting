<?php

namespace App\Http\Livewire\Admin;

use App\Models\Candidate;
use Livewire\Component;

class GetCandidateVotes extends Component
{
    public $candidates;
    public function render()
    {
        $this->candidates = Candidate::orderBy('id', 'DESC')->get();
        return view('livewire.admin.get-candidate-votes')->layout("layout.admin-app");
    }
}
