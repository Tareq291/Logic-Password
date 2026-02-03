<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $now = Carbon::now();
        $days = [
            'Sunday'    => 'الأحد',
            'Monday'    => 'الاثنين',
            'Tuesday'   => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday'  => 'الخميس',
            'Friday'    => 'الجمعة',
            'Saturday'  => 'السبت',
        ];

        $englishDay = $now->format('l');
        $arabicDay  = $days[$englishDay];
        $lettersCount = mb_strlen($arabicDay, 'UTF-8');

        $now = Carbon::now('Asia/Damascus');

        $hour = (int) $now->format('H');
        $effectiveHour = $hour;
        $expectedPassword = $lettersCount * $effectiveHour;


        $last = session('last_password');

        if ($last == $expectedPassword) {
            return back()->withErrors([
                'password' => 'لا يمكن استخدام نفس كلمة المرور مرتين متتاليتين'
            ]);
        }
        session(['last_password' => $expectedPassword]);

        if ((int)$request->password == $expectedPassword) {
            return back()->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors([
            'password' => 'كلمة المرور غير صحيحة'
        ]);
    }
}
