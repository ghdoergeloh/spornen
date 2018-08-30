# SponRun

## Beschreibung

SponRun ist eine Anwendung zur Verwaltung von Sponsorenläufen. Sie ist in der Zusammenarbeit mit [To All Nations e.V.](https://to-all-nations.de) und [Bibelseminar Bonn](https://bsb-online.de) entstanden. Das Problem war, dass Läufer ihre Sponsoren melden müssen, damit nach dem Lauf die Sponsoren informiert werden können. Um das nicht auf dem Papier machen zu müssen, kann sich jeder Läufer anmelden und seine Sponsoren selbst eintragen. Diese können durch den Admin als Tabelle exportiert werden. Andere Features ergänzen die App.

## Systemanforderungen
PHP >= 7.0

* PHP Extensions
* OpenSSL
* PDO
* Mbstring
* Tokenizer

[Composer](https://getcomposer.org/)

[npm](https://www.npmjs.com/)

## Installation

	git clone git@github.com:ghdoergeloh/sponrun.git

Dem Web-Server Nutzer Schreibrechte für die Verzeichnisse "storage" und "bootstrap/cache" gewähren.

VirtuellenHost einrichten auf das Verzeichnis "public".

Die Datei ".env.example" kopieren und in ".env" umbenennen.

Einstellungen für DB,URL,... in .env vornehmen.

Mit Composer alle PHP-Abhängigkeiten laden

* entweder für die Entwicklungsumgebung:

	composer install

* oder für den Server:

	composer install --no-dev

Außerdem für die Entwicklungsumgebung: mit npm alle JS-Abhängigkeiten laden

	npm install

App-Key erstellen:

	php artisan key:generate

Datenbank erzeugen.

Dann das DB-Schema generieren lassen:

	php artisan migrate

OAuth2 initiallisieren:

	php artisan passport:install
