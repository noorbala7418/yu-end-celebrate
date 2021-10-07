<?php

namespace App\Exports;

use App\Models\Anjoman;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentsExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $anjomans = Anjoman::all();
        foreach ($anjomans as $anjoman) {
            $sheets[] = new StudentsPerAnjomans($anjoman->id);
        }

        return $sheets;
    }
}
