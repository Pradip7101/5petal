<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::all();
        return view('admin.leads.index', compact('leads'));
    }
}
