# Finanzrechner
[![codecov](https://codecov.io/gh/demvsystems/steuersatzrechner/branch/master/graph/badge.svg)](https://codecov.io/gh/demvsystems/steuersatzrechner)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/demvsystems/finanzrechner/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/demvsystems/finanzrechner/?branch=master)

### Verschiedene Finanzberechnungen

- [Kapitalstock](src/Kapitalstock)
- [Krankentagegeld](src/Krankentagegeld)
- [Pension](src/Pension)
- [Rente](src/Rente)
- [Sparen](src/Sparen)


## Entwicklung

Zum Entwickeln ist ein Dockerfile enthalten.

### Setup

1. `$ cp ./.env.example ./.env`
2. Einen Github Token zur `.env` hinzufügen
3. `sh run.sh composer install`

### Benutzung

Es können Befehle im Docker Container ausgeführt werden:

`sh run.sh composer test`
