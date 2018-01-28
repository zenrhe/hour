<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends Controller
{
    public function index()
    {  
        $logs = Log::get();

        return view('logs.index', compact('logs'));

    }
    public function show(Log $log)
    {
        return view('logs.show', compact('log'));
    }
}
