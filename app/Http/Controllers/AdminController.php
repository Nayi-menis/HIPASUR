<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Horario;
use App\Models\Produccion;
use App\Models\Recurso;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Secretaria;

class AdminController extends Controller
{
    public function index(){
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_recursos = Recurso::count();
        $total_produccion = Produccion::count();
        $total_horarios = Horario::count();
        $total_alamacen = Almacen::count();
        return view('admin.usuarios.index'); 
        return view('admin.index', compact('total_usuarios', 
                  'total_secretarias',
                  'total_recursos',
                  'total_produccion', 
                  'total_horarios',
                  'total_almacen'));
    }
}
