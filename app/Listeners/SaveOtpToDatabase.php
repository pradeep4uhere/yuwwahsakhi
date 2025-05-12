<?php

namespace App\Listeners;

use App\Events\GenerateOtp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\MobileOtp;
use Carbon\Carbon;


class SaveOtpToDatabase
{

    /**
     * Handle the event.
     */
    public function handle(GenerateOtp $event): void
    {
        MobileOtp::create([
            'mobile_number' => $event->mobile,
            'otp' => $event->otp,
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_verified' => 0,
        ]);
    }
}
