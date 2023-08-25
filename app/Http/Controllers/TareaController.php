<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;    

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tareas = Tarea::all();
        return view('intranet.tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarea.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:30',
            'descripcion' => 'max:500',
            'fechaVencimiento' => 'required|max:250'
        ]);

        $tarea = new Tarea();
        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->fechaVencimiento = $request->fechaVencimiento;
        $tarea->save();

        return redirect('tareas')->with('state_messaje', 'tarea agregado exitosamente');
    }


    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);

        return view('tarea.show', compact('tarea'));
    }


    public function edit($id)
    {
        dd($id);
        $tarea = Tarea::findOrFail($id);

        return view('intranet.tareas.edit', compact('tarea'));
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:30',
            'descripcion' => 'max:500',
            'fechaVencimiento' => 'required'
        ]);
        $tarea = Tarea::findOrFail($request->id);
        $tarea->titulo = $request->titulo;
        $tarea->fechaVencimiento = $request->fechaVencimiento;
        $tarea->descripcion = $request->descripcion;
        $tarea->save();

        return redirect('tareas')->with('state_messaje', 'tarea Actualizado');
    }

    public function destroy($id)
    {
        Tarea::destroy($id);
        $mensaje = "tarea Eliminado";

        return redirect('tareas')->with('state_messaje', $mensaje);
    }
}