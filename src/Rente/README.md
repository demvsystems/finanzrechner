
# Rentenberechnungen

### Gesetzliche Rente
Berechnet des Anspruch auf Krankentagegeld bei gegebenem Einkommen mit der Berücksichtigung der
entsprechenden Bemessungsgrenze

Beispiel:
Berechnung des KTG mit einem Bruttojahresgehalt von 50.000€ und einem Nettojahreseinkommen von 40.000€


```php
(new KrankentagegeldRechner)->calc(50000, 40000); // 35000
```

### Erwerbsminderungsrente
Berechnet einen Schätzwert für die järhliche Erwerbsminderungsrente (Halb und Voll) auf Basis des 
Bruttojahreseinkommens unter berücksichtigung der BBG

Beispiel:
Bruttojahreseinkommen von 60.000€

```php
(new ErwerbsminderungsrenteRechner)->volleRente(60000); // 17400
(new ErwerbsminderungsrenteRechner)->halbeRente(60000); // 9000
```
