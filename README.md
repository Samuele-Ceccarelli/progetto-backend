# API REST in Laravel

Esempio di API REST sviluppata in Laravel per la gestione di clienti e delle relative pratiche.

## Prerequisiti e Versioni Utilizzate
* **PHP**: ^8.5.0
* **Composer**: ^2.7.0
* **MySQL**: ^26.7.0
* **Laravel**: ^13.x

---

## Istruzioni di Installazione e Configurazione

1. Clona la repository in locale:
   ```bash
   git clone <URL_REPOSITORY>
   cd <NOME_CARTELLA_PROGETTO>

2. Rinomina il file `.env.example` in `.env` e poi esegui:
   ```bash
   php artisan key:generate

3. All'interno del file `.env` modifica i seguenti valori inserendo i tuoi dati:
    ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=
   DB_USERNAME=root
   DB_PASSWORD

4. Crea il database (assicurarsi che il servizio MySQL sia in esecuzione):
   ```bash
   php artisan migrate

5. Avvia il server locale:
   ```bash
   php artisan serve

---

## Database e Test

1. Per popolare il database utilizzando le classi seeders, eseguire il comando:
   ```bash
   php artisan db:seed

2. Per avviare i test automatici, esegui:
   ```bash
   php artisan config:clear
   php artisan test

---

## Esempi di chiamate API
1. POST con endpoint /api/clienti
   ```json
    {
        "nome": "Samuele",
        "cognome": "Ceccarelli",
        "email": "samuele.ceccarelli@email.it"
    }
2. GET con endopoint /api/pratiche/2
   ```json
    {
        "data": {
            "id_pratica": 2,
            "id_cliente": 12,
            "importo": "8030626.38",
            "descrizione": "Itaque ad molestiae et quia repellendus accusantium.",
            "data_apertura": "1978-06-17T00:00:00.000000Z",
            "stato": "Chiusa"
        }
    }

---

## Motivazioni: scelte adottate
1. Concettualmente:
    - non ho utilizzato estensioni AI offerte da Laravel, per capire meglio il framework.
    - ho utilizzato Gemini invece per coprire i "buchi" della documentazione ufficiale.
    - ho preferito l'italiano per i metodi nei controller, invece che la convenzione (index, show, create,..), per chiarezza personale.

2. Tecnologia:
    - ho usato Composer, come indicato nella guida ufficiale.
    - ho usato Postman per il test delle API
---

## Sviluppi futuri
1. Riscrittura (parziale) del codice seguendo le convenzioni Laravel e utilizzo del solo inglese.
2. Ampliamento delle tabelle.
3. Utilizzo del caching e ottimizzazione delle risorse.
4. Implementazione agenti AI per la gestione delle pratiche.
5. Correggere l'indicizzazione '+10' per l'attributo `id_cliente` in pratica (mancanza di tempo)
    ```json
    ...
    "id_pratica": 1,
    "id_cliente": 11,
    ...
    ...
    "id_pratica": 2,
    "id_cliente": 12,
    ...
    
---

## Documentazione e Tools
1. Per la comprensione del framework e scrittura del codice:
    - https://laravel.com/framework/docs

2. Per capire se le scelte seguite fossero coerenti con la best practice:
    - https://www.youtube.com/@LaravelDaily/videos

3. Per il diagramma ER:
    - https://app.diagrams.net/

4. Per scrivere il codice e testare API:
    - Visual Studio Code.
    - Postman.

5. Per HTTP e SQL:
    - Dispense universitarie.

---

## Strumenti AI

Google Gemini:
* Correzioni e ricerca di alcuni metodi (e.g. `sentence()`).
* Sintassi enumeratore per le factory.
* Controllo sintassi validazione.
* Scrittura finale in `PraticaController.php` di `visualizzaPratiche()` e `modificaStatoPratica()`.
* Creazione test automatici.
* Revisione codice completo.
    
---

Tempo totale stimato: ~15 ore 
