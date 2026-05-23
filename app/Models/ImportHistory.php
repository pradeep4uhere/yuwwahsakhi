<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    use HasFactory;

    protected $fillable = [

        'total_rows',

        'processed_rows',

        'updated_rows',

        'inserted_rows',

        'logs',

        'status',
    ];

    protected $casts = [
        'logs' => 'array',
    ];
}
