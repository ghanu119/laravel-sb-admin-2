<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 
    /**
     * @name login
     * 
     * Show a login page
     */
    public function index () {
        
        $data = [];
        return view('admin.dashboard', $data);
    }
}
