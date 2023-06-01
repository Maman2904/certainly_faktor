<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hasil;
use Illuminate\Auth\Access\HandlesAuthorization;

class HasilPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Hasil $hasil)
    {
        return $user->id === $hasil->user_id || $user->hasRole('Admin');
    }
}
