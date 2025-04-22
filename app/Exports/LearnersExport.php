<?php

namespace App\Exports;
use App\Models\Learner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LearnersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Learner::select('id', 'first_name','last_name','email','gender', 'date_of_birth', 'created_at')->get();
    }


    public function headings(): array
    {
        return ['ID', 'First Name','Last Name', 'Email', 'Gender', 'Date of Birth','Created On'];
    }

}
