<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        $total_transactions = Transaction::count();
        $total_revenue = Transaction::total_revenue();
        $today_revenue_earned = Transaction::today_revenue_earned();
        $pending_transactions = Transaction::pending_transactions();
        $revenueData = $this->revenueOverview();
        $recent_transactions = Transaction::latest()->take(5)->get();
        return view('admin.index', compact('total_transactions',
            'total_revenue', 'today_revenue_earned', 'pending_transactions', 'revenueData', 'recent_transactions'));
    }


    public function payment(){

        $revenueData = $this->revenueOverview();
        $transactions = Transaction::latest()->paginate(10); // Paginate to display 10 transactions per page
        return view('admin.payment', compact('revenueData', 'transactions'));
    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }



    public function revenueOverview()
    {
        $monthlyRevenue = Transaction::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Format data for all months
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        return $revenueData;
    }

}
