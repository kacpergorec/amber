<?php

namespace App\Http\Controllers;

use App\Models\User;

final class DashboardController extends Controller
{
    public function __invoke()
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return view('dashboard', compact('users'));
    }
}
