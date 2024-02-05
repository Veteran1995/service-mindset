<?php

namespace App\Imports;

use App\Models\CustomerDetail;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Concerns\Importable as ImportableAlias;

class CustomersImport
{
    use Importable;

    public function import($filePath)
    {
        (new FastExcel)->import($filePath, function ($row) {
            // Create or update Customer record
            CustomerDetail::updateOrCreate(['email' => $row['email']], [
                'name' => $row['name'],
                'phone' => $row['phone'],
                // Add more columns as needed
            ]);
        });
    }
}

