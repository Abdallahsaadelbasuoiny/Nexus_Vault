<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;

class AdminMaintenanceController extends Controller
{
    // عرض جميع الطلبات
    public function index()
    {
        $requests = MaintenanceRequest::latest()->paginate(15);
        return view('admin.maintenance.index', compact('requests'));
    }

    // عرض تفاصيل طلب معين
    public function show($id)
    {
        $request = MaintenanceRequest::findOrFail($id);
        return view('admin.maintenance.show', compact('request'));
    }
}