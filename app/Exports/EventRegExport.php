<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\EventRegistration;
use App\Event;
use DB;

class EventRegExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    public $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
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
            ->join('event_registrations as er', 'u.id', '=', 'er.user_id')
            ->select(DB::raw('u.name as Name, u.email as `Mail Id`, u.mobile_number as `Mobile`, er.order_id as `Reg ID`'))
            ->where([['er.is_reg_success', true], ['er.event_id', $this->eventId]])
            ->get();

    }
}
