<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\WorkshopRegistration;
use DB;

class WorkshopRegExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public $workshopId;

    public function __construct($workshopId)
    {
        $this->workshopId = $workshopId;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Mail ID',
            'Mobile Number',
            'Reg Id'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return DB::table('users as u')
            ->join('workshop_registrations as wr', 'u.id', '=', 'wr.user_id')
            ->select(DB::raw('u.name as Name, u.email as `Mail Id`, u.mobile_number as `Mobile`, wr.order_id as `Reg ID`'))
            ->where([['wr.is_reg_success', true], ['wr.workshop_id', $this->workshopId]])
            ->get();

    }
}
