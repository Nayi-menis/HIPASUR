<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Horario;
use App\Models\Produccion;
use App\Models\Recurso;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Secretaria;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $rol = Auth::user()->role;

        // Datos para el Administrador
        $total_usuarios = User::count();
        $total_finanzas = Pago::sum('monto'); // Ejemplo: suma de ingresos

        // Datos para Personal (Solo su producción propia)
        $mi_produccion = \App\Models\Produccion::count();

        return view('admin.index', compact('total_usuarios', 'total_finanzas', 'mi_produccion'));
    }

}