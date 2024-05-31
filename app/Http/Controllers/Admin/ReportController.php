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

    public function customerFeedbackReportIndex()
    {
        return view('admin.report.customer-feedback');
    }

    public function inventoryReportIndex()
    {
        return view('admin.report.inventory');
    }

    public function overdueReportIndex()
    {
        return view('admin.report.overdue-report');
    }
}
