<?php

namespace App\Modules\Dashboard\Http\Controllers;


use App\Modules\Common\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class DashboardController extends Controller
{
    public function __invoke() : View
    {
        return view('dashboard');
    }
}
