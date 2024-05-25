<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index');
    }

    public function revenueReportIndex()
    {
        return view('admin.report.revenue-report');
    }

    public function rentalActReportIndex()
    {
        return view('admin.report.rental-activity');
    }
}
