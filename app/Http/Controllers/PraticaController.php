<?php

namespace App\Http\Controllers;

use App\Http\Resources\PraticaRisorsa;
use App\Models\Pratica;
use Illuminate\Http\Request;
use App\Enums\StatoPratica;
use Illuminate\Validation\Rules\Enum;

class PraticaController extends Controller
{
   public function aggiungiPratica(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => ['required', 'exists:clienti,id_cliente'],
            'importo' => ['required', 'numeric'],
            'descrizione' => ['required', 'string'],

            ['required' => 'Dati mancanti.',
            'importo.numeric' => 'Importo non valido.',
            'id_cliente.exists' => 'Cliente inesistente.']
        ]);

        $pratica = Pratica::create($validated);
        return new PraticaRisorsa($pratica);
    }

    public function visualizzaPratiche(Request $request)
    {
        $request->validate([
            'stato' => ['nullable', new Enum(StatoPratica::class)],
        ], [
            'stato' => 'Stato non valido.'
        ]);

        $query = Pratica::query();

        if ($request->filled('stato')) {
            $query->where('stato', $request->query('stato'));
        }

        return PraticaRisorsa::collection($query->get());
    }

    public function visualizzaPratica(Pratica $pratica)
    {
        return new PraticaRisorsa($pratica);
    }

    public function modificaStatoPratica(Request $request, Pratica $pratica)
    {
        $request->validate([
            'stato' => ['required', new Enum(StatoPratica::class)]
        ]);

        $nuovoStato = $request->enum('stato', StatoPratica::class);

        // 1. Regola logica
        $transizioneValida = match ($pratica->stato) {
            StatoPratica::NUOVA => $nuovoStato === StatoPratica::IN_LAVORAZIONE,
            StatoPratica::IN_LAVORAZIONE => $nuovoStato === StatoPratica::CHIUSA,
            StatoPratica::CHIUSA => false,
        };

        // 2. Controlla il cambio stato
        if (!$transizioneValida) {
            return response()->json([
                'message' => "Azione non consentita. Impossibile passare da '{$pratica->stato->value}' a '{$nuovoStato->value}'."
            ], 422);
        }

        // 3. Applica la modifica
        $pratica->update([
            'stato' => $nuovoStato
        ]);

        return new PraticaRisorsa($pratica);
    }
}
