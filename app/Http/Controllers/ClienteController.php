<?php

namespace App\Http\Controllers;
use App\Http\Resources\ClienteRisorsa;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function aggiungiCliente(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string'],
            'cognome' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:clienti,email'], 
            
            ['email.unique' => 'Email già utilizzata.',
            'required' => 'Dati mancanti.']
        ]);
        
        $cliente = Cliente::create($validated);

        if (!$cliente) {
            return response('Cliente', 200)
            ->header('Content-Type', 'text/plain');
        }

        return new ClienteRisorsa($cliente);
    }
}