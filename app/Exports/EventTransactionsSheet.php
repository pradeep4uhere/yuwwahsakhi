<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventTransactionsSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $events;

    public function __construct($events)
    {
        $this->events = $events;
    }

    public function collection()
    {
        return $this->events;
    }

    public function title(): string
    {
        return 'Event Transactions';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Beneficiary Name',
            'Beneficiary Phone Number',
            'Event Name',
            'Event Category',
            'Field Agent ID',
            'Monthly Income',
            'Event Status',
            'Created At',
            'Event Submitted'
           
        ];
    }
}
