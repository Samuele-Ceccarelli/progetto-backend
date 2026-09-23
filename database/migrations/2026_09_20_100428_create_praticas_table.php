<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatoPratica;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pratiche', function (Blueprint $table) {
            $table->id('id_pratica');
            $table->foreignId('id_cliente')->constrained('clienti', 'id_cliente');
            $table->decimal('importo', 10, 2)->unsigned();
            $table->text('descrizione');
            $table->timestamp('data_apertura')->useCurrent();
            $table->enum('stato', StatoPratica::values())
                  ->default(StatoPratica::NUOVA->value);
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pratiche');
    }
};
