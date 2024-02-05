<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\ServiceOrder;

class ImportServiceOrder extends Component
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
        $serviceOrders = ServiceOrder::with('customer')->paginate(10);

        return view('livewire.import-service-order', ['serviceOrders' => $serviceOrders]);
    }
}
