<?php

namespace Finanzrechner\Kapitalstock;

use function Dgame\Ensurance\ensure;

/**
 * Class KapitalstockRechner
 * @package Finanzrechner\Kapitalstock
 */
final class KapitalstockRechner
{
    /**
     * @var float
     */
    private $zinssatz;

    /**
     * KapitalstockRechner constructor.
     *
     * @param float $zinssatz
     *          Der Zinsatz in %
     */
    public function __construct(float $zinssatz)
    {
        ensure($zinssatz)->isPositive();
        $this->zinssatz = $zinssatz;
    }

    /**
     * Berechnet den benötigten Kapitalstock bei einer fixen monatlichen Entnahme über einen gegebene Zeitraum unter Berücksichtigung
     * der entstehenden Zinserträge
     *
     * @param float $monatlicheEntnahme
     * @param int   $laufzeit
     *      Die Laufzeit in Jahren
     *
     * @return float
     */
    public function calc(float $monatlicheEntnahme, int $laufzeit): float
    {
        ensure($monatlicheEntnahme)->isPositive();
        ensure($laufzeit)->isPositive();

        $kapitalstock = 0;
        for ($counter = 1; $counter <= $laufzeit; $counter++) {
            $kapitalstock = $kapitalstock / (1 + ($this->zinssatz / 100));
            $kapitalstock += $monatlicheEntnahme * 12;
        }

        return round($kapitalstock, 2);
    }
}
