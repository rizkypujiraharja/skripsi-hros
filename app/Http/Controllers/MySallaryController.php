<?php

namespace App\Http\Controllers;

use App\Sallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MySallaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sallaries = Sallary::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->latest()
            ->where('user_id', $user->id);

        $sallaries = $sallaries->paginate()->withQueryString();

        return view('my-sallaries.index', compact('sallaries', 'user'));
    }
}
