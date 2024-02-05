<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\ServiceOrder;

class ImportMeter extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $import = new CustomersImport();
        $import->import($this->file('file'));
    }

    public function render()
    {
        $meters = Meter::with('customer')->paginate(10);

        return view('livewire.import-meter', ['meters' => $meters]);
    }
}
