<?php

namespace App\Http\Controllers\Admin;

use App\Loan;
use App\User;
use App\Contribution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $all_contributions = Contribution::sum('amount');
        $all_loans = Loan::sum('amount');
        return view('admin.dashboard', compact('users', 'all_contributions', 'all_loans'));
    }
}
