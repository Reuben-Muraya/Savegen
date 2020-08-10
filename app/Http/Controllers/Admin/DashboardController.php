<?php

namespace App\Http\Controllers\Admin;

use App\Loan;
use App\User;
use App\Expense;
use App\Project;
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
        $all_expenses = Expense::sum('amount');
        $all_projects = Project::sum('deal_value');
        return view('admin.dashboard', compact('users', 'all_contributions', 'all_loans', 'all_expenses','all_projects'));
    }
}
