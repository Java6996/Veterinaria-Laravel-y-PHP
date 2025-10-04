<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnostico;
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;

class DiagnosticoController extends Controller
{
    // Dashboard inicial
    public function dashboard()
    {
        return view('empleado.diagnosticos.diagnostico');
    }

    // Mostrar formulario de creación
    public function create()
    {
        $mascotas = Mascota::with('user')->get(); // Mascotas con su dueño
        return view('empleado.crudDiagnostico.crearDiagnostico', compact('mascotas'));
    }

    // Guardar nuevo diagnóstico
    public function store(Request $request)
    {
        $data = $request->validate([
            'sintomas' => 'required|string|max:1000',
            'diagnostico' => 'required|string|max:1000',
            'tratamiento' => 'required|string|max:1000',
            'mascota_id' => 'required|exists:mascotas,id_mascota'
        ]);

        $data['user_id'] = Auth::id();
        $data['fecha'] = now();
        // $data['descripcion'] = "Diagnóstico generado automáticamente."; // 

        Diagnostico::create($data);

        return redirect()->route('empleado.diagnostico')
            ->with('success', 'El diagnóstico ha sido creado correctamente.');
    }


    // Mostrar detalle (opcional)
    public function show(Diagnostico $diagnostico)
    {
        return view('empleado.diagnosticos.show', compact('diagnostico'));
    }

    // Formulario de edición
    public function edit(Diagnostico $diagnostico)
    {
        $mascotas = Mascota::with('user')->get();
        return view('empleado.crudDiagnostico.editarDiagnostico', compact('diagnostico', 'mascotas'));
    }

    // Actualizar diagnóstico
    public function update(Request $request, Diagnostico $diagnostico)
    {
        $data = $request->validate([
            'sintomas' => 'required|string|max:1000',
            'diagnostico' => 'required|string|max:1000',
            'tratamiento' => 'required|string|max:1000',
            'mascota_id' => 'required|exists:mascotas,id_mascota',
        ]);

        $diagnostico->update($data);

        return redirect()->route('empleado.diagnostico')->with('success', 'El diagnóstico ha sido actualizado correctamente.');
    }


    // Eliminar diagnóstico
    public function destroy(Diagnostico $diagnostico)
    {
        $diagnostico->delete();
        return redirect()->route('empleado.diagnostico')->with('success', 'El diagnóstico ha sido eliminado correctamente.');
    }
}
