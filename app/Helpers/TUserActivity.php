<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait TUserActivity
{
    /**
     * Save user activity
     */
    public function userActivity(string $activity): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'ip' => $this->ip(),
            'agent' => $this->header('User-Agent')
        ]);
    }
}
