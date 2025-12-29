<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HorarioController extends Controller
{
    // LISTADO: Historial general de registros
    public function index()
    {
        $horarios = Horario::with('recurso')->orderBy('fecha', 'desc')->get();
        return view('admin.horarios.index', compact('horarios'));
    }

    // REGISTRO: Formulario para crear entrada
    public function create()
    {
        $recursos = Recurso::all();
        return view('admin.horarios.create', compact('recursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recurso_id' => 'required',
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'turno' => 'required',
        ]);

        $horario = new Horario();
        // Verifica en tu DB si es recurso_id o recursos_id
        $horario->recurso_id = $request->recurso_id; 
        $horario->fecha = $request->fecha;
        $horario->hora_entrada = $request->hora_entrada;
        $horario->hora_salida = $request->hora_salida;
        $horario->turno = $request->turno;
        $horario->observaciones = $request->observaciones;
        $horario->save();

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Asistencia registrada correctamente')
            ->with('icono', 'success');
    }

    public function show($id)
    {
        $horario = Horario::with('recurso')->findOrFail($id);
        return view('admin.horarios.show', compact('horario'));
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $recursos = Recurso::all();
        return view('admin.horarios.edit', compact('horario', 'recursos'));
    }

    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Registro actualizado')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        Horario::destroy($id);
        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Registro eliminado')
            ->with('icono', 'success');
    }

    public function control()
    {
        $trabajadores = Recurso::with(['horarios' => function($query) {
            $query->whereDate('fecha', Carbon::today());
        }])->get();

        return view('admin.horarios.control', compact('trabajadores'));
    }

 }