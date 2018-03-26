
# Sparen

### Sparraten
Berechnet die monatlich benötigte Sparrate zum Aufbau eines gegebene Kapitalstocks und Laufzeit 
unter Berücksichtuung der Zinserträge. 

Beispiel:
Kapitalstock: 406.486€
Aufbau über 40 Jahre
Verzinsung: 3%


```php
(new SparratenRechner(3))->calc(406486, 40); // 449.25
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
