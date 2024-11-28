<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من وجود الملف في الطلب
        $request->validate([
            'photo' => 'required|file|max:1024', // التحقق من أن الملف موجود ولا يتجاوز 1 ميجابايت
        ]);

        // الحصول على اسم الملف الأصلي
        $filename = $request->file('photo')->getClientOriginalName();

        // رفع الملف إلى المجلد 'public/offices' وتخزينه مع الاسم الأصلي
        $path = $request->file('photo')->storeAs('public/offices', $filename);

        // إنشاء السجل الجديد في قاعدة البيانات
        Office::create([
            'name' => $request->name,
            'photo' => $filename,  // حفظ اسم الملف في قاعدة البيانات
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }
}
