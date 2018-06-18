<?php

namespace Finanzrechner\Krankentagegeld;

use Demv\Werte\Beitragsbemessung\BBG;
use function Dgame\Ensurance\ensure;

/**
 * Class KrankentagegeldRechner
 * @package Finanzrechner\Krankentagegeld
 */
final class KrankentagegeldRechner
{
    private const ARBEITNEHMER_ANTEIL = 0.12;

    private const BRUTTOSATZ = 0.7;

    private const NETTOSATZ = 0.9;

    /**
     * @param float $bruttojahresgehalt
     * @param float $nettojahresgehalt
     *
     * @return float
     */
    public function calc(float $bruttojahresgehalt, float $nettojahresgehalt): float
    {
        ensure($bruttojahresgehalt)->isNumeric()->isGreaterOrEqualTo($nettojahresgehalt);
        ensure($bruttojahresgehalt)->isPositive();
        ensure($nettojahresgehalt)->isPositive();

        $values = [self::BRUTTOSATZ * BBG::KRANKEN_UND_PFLEGE];
        if ($bruttojahresgehalt > 0) {
            $values[] = self::BRUTTOSATZ * $bruttojahresgehalt;
        }
        if ($nettojahresgehalt > 0) {
            $values[] = self::NETTOSATZ * $nettojahresgehalt;
        }

        return round(min($values) * (1 - self::ARBEITNEHMER_ANTEIL), 2);
    }
}
