<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;

final class DashboardController extends Controller
{
    public function __invoke() : View
    {
        return view('dashboard');
    }
}
