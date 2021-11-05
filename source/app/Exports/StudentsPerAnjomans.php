<?php

namespace App\Exports;

use App\Models\Anjoman;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentsPerAnjomans implements FromCollection, WithTitle, WithHeadings
{
    private $anjomanId;

    public function __construct(int $id)
    {
        $this->anjomanId  = $id;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return Student::query()
            ->select('stdID', 'name', 'family', 'mobile', 'hamrahan', 'tandis', 'launchs', 'dinners', 'bill')
            ->where('anjoman_id', '=', $this->anjomanId)
            ->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $name = Anjoman::query()->findOrFail($this->anjomanId)->name;
        return 'رشته ' . $name;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'شماره دانشجویی',
            'نام',
            'نام خانوادگی',
            'موبایل',
            'تعداد همراه',
            'تندیس',
            'ناهار',
            'شام',
            'مبلغ پرداختی'
        ];
    }
}
