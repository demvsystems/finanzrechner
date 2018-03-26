
# Berechnung des Kapitalstocks
Berechnet den benötigten Kapitalstock bei gegebener monatlicher Entnahme und Gesamtlaufzeit

Beispiel:
Der Kapitalstock soll bei einer monatlichen Entnahme von 2.000€ und einer
 jährlichen Verzinsung on 3% 23 Jahre lang halten.

```php
$rechner = new KapitalstockRechner(3);

$kapitalstock = $rechner->calc(2000, 23); // 406486
```
