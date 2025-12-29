<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user ? $user->role : null;

        // Si un administrativo intenta entrar a /home, lo mandamos a su panel
        if ($role == 'administrador' || $role == 'secretaria') {
            return redirect('/admin');
        }

        return view('home'); // Solo el personal ve la pestaña con la imagen
    }
}
