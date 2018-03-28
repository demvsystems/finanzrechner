<?php

namespace Finanzrechner\Krankentagegeld;

use Demv\Utils\BruttoNettoRechner\BruttoNettoRechner;
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
     * @param float      $nettojahresgehalt
     * @param float|null $bruttojahresgehalt
     *
     * @return float
     */
    public function calc(float $nettojahresgehalt, float $bruttojahresgehalt = null): float
    {
        ensure($nettojahresgehalt)->isPositive();

        if ($bruttojahresgehalt === null) {
            $bruttojahresgehalt = BruttoNettoRechner::new()->convertNettoToBrutto($nettojahresgehalt);
        }

        ensure($bruttojahresgehalt)->isNumeric()->isGreaterOrEqualTo($nettojahresgehalt);
        ensure($bruttojahresgehalt)->isPositive();

        return round(min(self::BRUTTOSATZ * $bruttojahresgehalt,
                         self::NETTOSATZ * $nettojahresgehalt,
                         self::BRUTTOSATZ * BBG::KRANKEN_UND_PFLEGE), 2);
    }
}
