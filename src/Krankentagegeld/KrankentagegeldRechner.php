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

        return round(min(self::BRUTTOSATZ * $bruttojahresgehalt,
                         self::NETTOSATZ * $nettojahresgehalt,
                         self::BRUTTOSATZ * BBG::KRANKEN_UND_PFLEGE), 2);
    }
}
