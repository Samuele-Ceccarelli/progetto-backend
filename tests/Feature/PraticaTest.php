<?php

namespace Tests\Feature;

use App\Models\Pratica;
use App\Models\Cliente;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\StatoPratica;

class PraticaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Test di creazione corretta di una pratica.
     */
    public function test_creazione_corretta_di_una_pratica()
    {
        // Arrange: Creo un cliente di supporto
        $cliente = Cliente::create([
            'nome' => 'Mario',
            'cognome' => 'Rossi',
            'email' => 'mario.rossi@example.com',
        ]);

        // Act: Invio la richiesta POST per creare la pratica
        $response = $this->postJson('/api/pratiche', [
            'id_cliente' => $cliente->id_cliente,
            'importo' => 1250.00,
            'descrizione' => 'Pratica di consulenza tecnica',
        ]);

        // Assert: Verifico lo status di successo e la presenza nel database
        $response->assertStatus(201);
        
        $this->assertDatabaseHas('pratiche', [
            'id_cliente' => $cliente->id_cliente,
            'importo' => 1250.00,
            'descrizione' => 'Pratica di consulenza tecnica',
            'stato' => StatoPratica::NUOVA->value,
        ]);
    }

    /**
     * 2. Test del rifiuto di una pratica con importo non valido.
     */
    public function test_rifiuto_pratica_con_importo_non_valido()
    {
        // Arrange: Creo un cliente di supporto
        $cliente = Cliente::create([
            'nome' => 'Luigi',
            'cognome' => 'Verdi',
            'email' => 'luigi.verdi@example.com',
        ]);

        // Act: Invio un importo non numerico che viola la validazione
        $response = $this->postJson('/api/pratiche', [
            'id_cliente' => $cliente->id_cliente,
            'importo' => 'importo-non-valido',
            'descrizione' => 'Test importo errato',
        ]);

        // Assert: Verifico che la richiesta venga scartata con errore di validazione (422)
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['importo']);
    }

    /**
     * 3. Test del rifiuto del tentativo di riaprire una pratica chiusa.
     */
    public function test_rifiuto_tentativo_riapertura_pratica_chiusa()
    {
        // Arrange: Creo un cliente e una pratica già nello stato CHIUSA
        $cliente = Cliente::create([
            'nome' => 'Anna',
            'cognome' => 'Neri',
            'email' => 'anna.neri@example.com',
        ]);

        $pratica = Pratica::create([
            'id_cliente' => $cliente->id_cliente,
            'importo' => 300.00,
            'descrizione' => 'Pratica chiusa',
            'stato' => StatoPratica::CHIUSA,
        ]);

        // Act: Provo a modificare lo stato facendolo tornare a 'in_lavorazione' (riapertura)
        $response = $this->patchJson("/api/pratiche/{$pratica->id_pratica}/stato", [
            'stato' => StatoPratica::IN_LAVORAZIONE->value,
        ]);

        // Assert: Verifico il blocco della transizione logica (codice 422) e il messaggio d'errore
        $response->assertStatus(422);
        $response->assertJsonFragment([
            'message' => "Azione non consentita. Impossibile passare da 'Chiusa' a 'In lavorazione'."
        ]);
    }
}