<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mascota;
use App\Models\Factura;
use App\Models\Diagnostico;

class EmpleadoController extends Controller
{
    public function dashboard()
    {
        return view('empleado.dashboard');
    }

    public function usuarios()
    {
        $users = User::whereIn('role', ['cliente', 'empleado'])->get();
        return view('empleado.usuario', compact('users'));
    }

    public function facturas()
    {
        $facturas = Factura::with('user')->get();
        return view('empleado.factura', compact('facturas'));
    }

    // Métodos CRUD para facturas
    public function createFactura()
    {
        $clientes = User::where('role', 'cliente')->get();
        return view('empleado.crudFactura.crearFactura', compact('clientes'));
    }

    public function storeFactura(Request $request)
    {
        try {
            $request->validate([
                'monto' => 'required|numeric|min:0',
                'fecha_emision' => 'required|date',
                'estado_pago' => 'required|in:Pendiente,Pagado',
                'email' => 'required|email',
                'user_id' => 'required|exists:users,id'
            ], [
                'monto.required' => 'El monto es obligatorio.',
                'monto.numeric' => 'El monto debe ser un número.',
                'monto.min' => 'El monto debe ser mayor a 0.',
                'fecha_emision.required' => 'La fecha de emisión es obligatoria.',
                'fecha_emision.date' => 'La fecha de emisión debe ser una fecha válida.',
                'estado_pago.required' => 'El estado de pago es obligatorio.',
                'estado_pago.in' => 'El estado de pago debe ser Pendiente o Pagado.',
                'email.required' => 'El email es obligatorio.',
                'email.email' => 'El formato del email no es válido.',
                'user_id.required' => 'El cliente es obligatorio.',
                'user_id.exists' => 'El cliente seleccionado no existe.'
            ]);

            Factura::create([
                'monto' => $request->monto,
                'fecha_emision' => $request->fecha_emision,
                'estado_pago' => $request->estado_pago,
                'email' => $request->email,
                'user_id' => $request->user_id,
            ]);

            return redirect()->route('empleado.factura')->with('success', 'Factura creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la factura: ' . $e->getMessage())->withInput();
        }
    }

    public function editFactura($id)
    {
        $factura = Factura::findOrFail($id);
        $clientes = User::where('role', 'cliente')->get();
        return view('empleado.crudFactura.editarFactura', compact('factura', 'clientes'));
    }

    public function updateFactura(Request $request, $id)
    {
        try {
            $factura = Factura::findOrFail($id);

            $request->validate([
                'monto' => 'required|numeric|min:0',
                'fecha_emision' => 'required|date',
                'estado_pago' => 'required|in:Pendiente,Pagado',
                'email' => 'required|email',
                'user_id' => 'required|exists:users,id'
            ], [
                'monto.required' => 'El monto es obligatorio.',
                'monto.numeric' => 'El monto debe ser un número.',
                'monto.min' => 'El monto debe ser mayor a 0.',
                'fecha_emision.required' => 'La fecha de emisión es obligatoria.',
                'fecha_emision.date' => 'La fecha de emisión debe ser una fecha válida.',
                'estado_pago.required' => 'El estado de pago es obligatorio.',
                'estado_pago.in' => 'El estado de pago debe ser Pendiente o Pagado.',
                'email.required' => 'El email es obligatorio.',
                'email.email' => 'El formato del email no es válido.',
                'user_id.required' => 'El cliente es obligatorio.',
                'user_id.exists' => 'El cliente seleccionado no existe.'
            ]);

            $factura->update([
                'monto' => $request->monto,
                'fecha_emision' => $request->fecha_emision,
                'estado_pago' => $request->estado_pago,
                'email' => $request->email,
                'user_id' => $request->user_id,
            ]);

            return redirect()->route('empleado.factura')->with('success', 'Factura actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la factura: ' . $e->getMessage())->withInput();
        }
    }

    public function destroyFactura($id)
    {
        try {
            $factura = Factura::findOrFail($id);
            $factura->delete();

            return redirect()->route('empleado.factura')->with('success', 'Factura eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('empleado.factura')->with('error', 'Error al eliminar la factura: ' . $e->getMessage());
        }
    }

    public function mascotas()
    {
        $mascotas = Mascota::with('user')->get();
        return view('empleado.mascota', compact('mascotas'));
    }

    public function diagnostico()
    {
        $diagnosticos = Diagnostico::with(['mascota' => function ($query) {
        $query->select('id_mascota', 'nombre', 'user_id'); 
        }])->get();


        return view('empleado.diagnostico', compact('diagnosticos'));
    
    }

// Métodos CRUD para usuarios
// crear
        public function createUsuario()
        {
            return view('empleado.crudUsuario.crearUsuario');
        }

        public function storeUsuario(Request $request)
        {
            try {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:6',
                    'role' => 'required|string|in:cliente,empleado'
                ], [
                    'name.required' => 'El nombre es obligatorio.',
                    'name.max' => 'El nombre no puede tener más de 255 caracteres.',
                    'email.required' => 'El email es obligatorio.',
                    'email.email' => 'El formato del email no es válido.',
                    'email.unique' => 'Este email ya está registrado.',
                    'password.required' => 'La contraseña es obligatoria.',
                    'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                    'role.required' => 'El rol es obligatorio.',
                    'role.in' => 'El rol debe ser cliente o empleado.'
                ]);

                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role,
                ]);

                return redirect()->route('empleado.usuarios')->with('success', 'Usuario creado correctamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al crear el usuario: ' . $e->getMessage())->withInput();
            }
        }
//editar y actualizar
        public function editUsuario($id)
        {
            $usuario = User::findOrFail($id);
            return view('empleado.crudUsuario.editarUsuario', compact('usuario'));
        }

        public function updateUsuario(Request $request, $id)
        {
            try {
                $usuario = User::findOrFail($id);

                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $usuario->id,
                    'role' => 'required|string|in:cliente,empleado'
                ], [
                    'name.required' => 'El nombre es obligatorio.',
                    'name.max' => 'El nombre no puede tener más de 255 caracteres.',
                    'email.required' => 'El email es obligatorio.',
                    'email.email' => 'El formato del email no es válido.',
                    'email.unique' => 'Este email ya está registrado.',
                    'role.required' => 'El rol es obligatorio.',
                    'role.in' => 'El rol debe ser cliente o empleado.'
                ]);

                $usuario->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role
                ]);

                return redirect()->route('empleado.usuarios')->with('success', 'Usuario actualizado correctamente.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage())->withInput();
            }
        }
// eliminar
        public function destroyUsuario($id)
        {
            try {
                $usuario = User::findOrFail($id);
                $usuario->delete();

                return redirect()->route('empleado.usuarios')->with('success', 'Usuario eliminado correctamente.');
            } catch (\Exception $e) {
                return redirect()->route('empleado.usuarios')->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
            }
        }

        // Métodos de búsqueda
        public function buscarUsuarios(Request $request)
        {
            $query = $request->get('query');
            $users = User::whereIn('role', ['cliente', 'empleado'])
                        ->where(function($q) use ($query) {
                            $q->where('name', 'LIKE', "%{$query}%")
                              ->orWhere('email', 'LIKE', "%{$query}%")
                              ->orWhere('role', 'LIKE', "%{$query}%");
                        })
                        ->get();
            
            return response()->json($users);
        }

        public function buscarMascotas(Request $request)
        {
            $query = $request->get('query');
            $mascotas = Mascota::with('user')
                        ->where(function($q) use ($query) {
                            $q->where('nombre', 'LIKE', "%{$query}%")
                              ->orWhere('especie', 'LIKE', "%{$query}%")
                              ->orWhere('raza', 'LIKE', "%{$query}%")
                              ->orWhereHas('user', function($userQuery) use ($query) {
                                  $userQuery->where('name', 'LIKE', "%{$query}%");
                              });
                        })
                        ->get();
            
            return response()->json($mascotas);
        }

        public function buscarDiagnosticos(Request $request)
        {
            $query = $request->get('query');
            $diagnosticos = Diagnostico::with(['mascota' => function ($query) {
                $query->select('id_mascota', 'nombre', 'user_id'); 
            }])
            ->where(function($q) use ($query) {
                $q->where('sintomas', 'LIKE', "%{$query}%")
                  ->orWhere('diagnostico', 'LIKE', "%{$query}%")
                  ->orWhere('tratamiento', 'LIKE', "%{$query}%")
                  ->orWhereHas('mascota', function($mascotaQuery) use ($query) {
                      $mascotaQuery->where('nombre', 'LIKE', "%{$query}%");
                  });
            })
            ->get();
            
            return response()->json($diagnosticos);
        }

        public function buscarFacturas(Request $request)
        {
            $query = $request->get('query');
            $facturas = Factura::with('user')
                        ->where(function($q) use ($query) {
                            $q->where('email', 'LIKE', "%{$query}%")
                              ->orWhere('estado_pago', 'LIKE', "%{$query}%")
                              ->orWhere('monto', 'LIKE', "%{$query}%")
                              ->orWhereHas('user', function($userQuery) use ($query) {
                                  $userQuery->where('name', 'LIKE', "%{$query}%");
                              });
                        })
                        ->get();
            
            return response()->json($facturas);
        }
}