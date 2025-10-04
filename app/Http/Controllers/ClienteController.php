<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Factura; // Modelo para las facturas
use App\Models\Mascota; // Modelo para las mascotas
use App\Models\Diagnostico; // Modelo para los diagnósticos
class ClienteController extends Controller
{
    public function dashboard()
    {
        return view('cliente.dashboard'); // Vista de inicio del cliente
    }
    public function facturas()
    {
        $clienteId = Auth::id(); // Obtiene el ID del cliente autenticado
        //$facturas = Factura::where('user_id', $clienteId)->get(); // Obtiene las facturas del cliente
        $facturas = Auth::user()->facturas;
        return view('cliente.clienteFacturas', compact('facturas')); // Pasa las facturas a la vista
    }
    public function mascotas()
    {
        $clienteId = Auth::id(); // Obtiene el ID del cliente autenticado
        $mascotas = Mascota::where('user_id', $clienteId)->get(); // Obtiene las mascotas del cliente
        return view('cliente.clienteMascotas', compact('mascotas')); // Pasa las mascotas a la vista
    }
    public function diagnostico()
    {
        $clienteId = Auth::id(); // Obtener ID del usuario autenticado

        // Obtener diagnósticos de mascotas que pertenecen al cliente
        //$diagnosticos = Diagnostico::whereHas('mascota', function ($query) use ($clienteId) {
          //  $query->where('user_id', $clienteId);
        //})->with(['mascota', 'user'])->get();
        $diagnosticos = Diagnostico::whereHas('mascota', function ($query) use ($clienteId) {
            $query->where('user_id', $clienteId);
        })->get();
        return view('cliente.ClienteDiagnostico', compact('diagnosticos'));
    }

}