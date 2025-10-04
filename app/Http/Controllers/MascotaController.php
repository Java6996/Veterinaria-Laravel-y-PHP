<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mascota;

class MascotaController extends Controller
{
    
    // Mostrar formulario de creación (ruta: /mascotas/crear)
    public function create()
    {
    $clientes = User::where('role', 'cliente')->get();
    return view('empleado.crudMascota.crearMascota', compact('clientes'));
    }

    // Guardar nueva mascota (ruta: POST /mascotas)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'nullable|string|max:45',
            'raza' => 'nullable|string|max:45',
            'fecha_nacimiento' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Mascota::create($request->all());

        return redirect()->route('empleado.mascota')->with('success', 'La mascota ha sido creada correctamente.');
    }

    // Ver detalle de una mascota (opcional) - ruta: /mascotas/{mascota}
    public function show(Mascota $mascota)
    {
        return view('empleado.mascotas.show', compact('mascota'));
    }

    // Formulario para editar mascota (ruta: /mascotas/{mascota}/editar)
    public function edit(Mascota $mascota)
    {
        $usuarios = User::all(); // Trae todos los usuarios (dueños posibles)

        return view('empleado.crudMascota.editarMascota', compact('mascota', 'usuarios'));
    }

    // Actualizar mascota (ruta: PUT /mascotas/{mascota})
    public function update(Request $request, Mascota $mascota)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'nullable|string|max:45',
            'raza' => 'nullable|string|max:45',
            'fecha_nacimiento' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $mascota->update($request->all());

        return redirect()->route('empleado.mascota')->with('success', 'La mascota ha sido actualizada correctamente.');
    }

    // Eliminar mascota (ruta: DELETE /mascotas/{mascota})
    public function destroy(Mascota $mascota)
    {
        $mascota->delete();

        return redirect()->route('empleado.mascota')->with('success', 'Mascota eliminada correctamente.');
    }

    // Listado para cliente autenticado (ruta: /cliente/mascotas)
    public function mascotas()
    {
        $mascotas = Mascota::where('user_id', auth()->id())->get();
        return view('cliente.clienteMascotas', compact('mascotas'));
    }
// relacion user - diagnostico
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class, 'mascota_id');
    }

}