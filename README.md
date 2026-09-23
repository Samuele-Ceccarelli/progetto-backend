# API REST Gestione Pratiche - Laravel & MySQL

API RESTful sviluppata in Laravel per la gestione di clienti e delle relative pratiche commerciali/legali, con gestione avanzata delle transizioni di stato.

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

## Database e Test

1. Per popolare il database utilizzando le classi seeders, eseguire il comando:
   ```bash
   php artisan db:seed

2. Per avviare i test automatici, esegui:
   ```bash
   php artisan config:clear
   php artisan test

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

## Motivazioni alle scelte prese

1. Progettazione concettuale: 
2. Tecnologia: ho scelto di non utilizzare estensioni AI offerte da Laravel
