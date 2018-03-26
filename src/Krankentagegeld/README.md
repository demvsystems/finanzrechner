
# Berechnung des Krankentagegeldes
Berechnet des Anspruch auf Krankentagegeld bei gegebenem Einkommen mit der Berücksichtigung der
entsprechenden Bemessungsgrenze

Beispiel:
Berechnung des KTG mit einem Bruttojahresgehalt von 50.000€ und einem Nettojahreseinkommen von 40.000€


```php
(new KrankentagegeldRechner())->calc(50000, 40000); // 35000
```
