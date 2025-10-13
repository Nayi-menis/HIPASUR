<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $total_usuarios = User::count();
        #$total_secretarias = Secretaria::count();
        #$total_pacientes = Paciente::count();
        #$total_consultorios = Consultorio::count();
        #$total_doctores = Doctor::count();
        #$total_horarios = Horario::count();
        return view('admin.usuarios.index'); 
        #return view('admin.index', compact('total_usuarios', 
         #           'total_secretarias',
          #          'total_pacientes',
           #         'total_consultorios', 
            #        'total_doctores',
             #       'total_horarios'));
    }
}
