<?php

namespace App\Http\Livewire\Admin\Crews;

use App\Models\Crew;
use App\Models\CrewMember;
use App\Models\User;
use Livewire\Component;

class Members extends Component
{
    public $crew;

    public function mount(Crew $crew_id)
    {
        $this->crew = $crew_id;
    }

    public function removeMember(User $id)
    {
        CrewMember::where('crew_id', $this->crew->id)->where('member_id', $id->employee_id)->delete();
        $this->mount($this->crew);
        $this->dispatchBrowserEvent('success', ['message' => $id->firstname . ' ' . $id->lastname . ' Remove From ' . $this->crew->name]);
    }
    public function render()
    {
        return view('livewire.admin.crews.members');
    }
}
