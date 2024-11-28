<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    public function store(Request $request)
    {
        // 1. الحصول على اسم الملف الأصلي
        $filename = $request->file('photo')->getClientOriginalName();

        // 2. رفع الصورة إلى المجلد 'shops'
        $request->file('photo')->storeAs('shops', $filename);

        // 3. تغيير حجم الصورة باستخدام Intervention Image
        $image = Image::make(storage_path('app/shops/' . $filename));  // تحميل الصورة من المسار

        // 4. تغيير الحجم إلى 500x500 بيكسل
        $image->resize(500, 500);

        // 5. حفظ الصورة المعدلة باسم جديد (resized-{$filename})
        $resizedFilename = 'resized-' . $filename;
        $image->save(storage_path('app/shops/' . $resizedFilename));  // حفظ الصورة المعدلة في المجلد نفسه

        return 'Success';
    }
}
