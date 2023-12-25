<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{


  public function handle($request, Closure $next)
  {
    if (auth('web')->check()) {
      return redirect(RouteServiceProvider::HOME);
    }

    if (auth('admin')->check()) {
      return redirect(RouteServiceProvider::ADMIN);
    }

    if (auth('doctor')->check()) {
      return redirect(RouteServiceProvider::DOCTOR);
    }

    if (auth('ray_employee')->check()) {
      return redirect(RouteServiceProvider::RayEmployee);
    }

    if (auth('laboratorie')->check()) {
      return redirect(RouteServiceProvider::LABORATORIE);
    }

    if (auth('patient')->check()) {
      return redirect(RouteServiceProvider::PATIENT);
    }
    
    if (auth('pharmacy')->check()) {
      return redirect(RouteServiceProvider::PHARMACY);
    }
    
    return $next($request);
  }
}
