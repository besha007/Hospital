<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ParmacistRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParmacistController extends Controller
{
   
    public function store(ParmacistRequest $request)
    {
        if($request->authenticate())
        {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::PHARMACY);
        }
        
        //  return redirect()->back()->withErrors(['name'=>'يوجد خطأ في البريد الالكتروني او كلمة المرور']);
        return redirect()->back()->withErrors(['name'=>(trans('Dashboard/auth.failed'))]);
   
    }

  
    public function destroy(Request $request): RedirectResponse
    {
        
        Auth::guard('pharmacy')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}