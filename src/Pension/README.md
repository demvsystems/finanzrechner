
# Berechnung der Beamtenpension
Berechnet den Pensionsanspruch von Beamten. Dieser berechnet sich aus dem
Pensionssatz-Faktor, den geleisteten Dienstjahren sowie den Dienstbezügen bzw. der
Besoldung. Sind bisher weniger als fünf Diensjahre abgleistet worden, erhält der Beamte
keine Pension. Die minimale Pension beläuft sich auf 35%, die maximale Pension auf
71.75% der ehemaligen Dienstbezüge.

Beispiel:
Berechnung der Pension für 25 abgeleistete Dienstjahre bei monatlichen Dienstbezügen
von 1000€


```php
$rechner = new BeamtenPensionRechner();

$rechner->setDienstzeitbeginn(2000);
$rechner->setPensionseintritt(2025);

// Pensionssatz-Faktor * Anzahl Dienstjahre / 100 * Dienstbezüge
$pension = 1.79375 * 25 / 100 * 1000;

$rechner->calc(1000); // 448.44 €
```
