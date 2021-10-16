<?php

namespace App\Exports;
use App\Models\Anjoman;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class HamrahExport implements WithMultipleSheets
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
            $sheets[] = new HamrahPerAnjomans($anjoman->id);
        }

        return $sheets;
    }
}
