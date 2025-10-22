<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventCommentsSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $comments;
    protected $title;

    public function __construct($title, $comments)
    {
        $this->title = $title;
        $this->comments = $comments;
    }

    public function collection()
    {
        return $this->comments;
    }

    public function title(): string
    {
        // Sheet name must be <= 31 chars
        return substr($this->title, 0, 31);
    }

    public function headings(): array
    {
        return ['Comment', 'Comment Type', 'Comment By', 'Comment Date'];
    }
}
