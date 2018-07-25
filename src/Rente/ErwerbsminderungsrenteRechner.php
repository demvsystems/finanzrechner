<?php

namespace Finanzrechner\Rente;

use Demv\Werte\Beitragsbemessung\BBG;

/**
 * Class ErwerbsminderungsrenteRechner
 * @package Finanzrechner\Rente
 */
final class ErwerbsminderungsrenteRechner
{
    private const FAKTOR_VOLL = 0.38;
    private const FAKTOR_HALB = 0.18;

    /**
     * @param float $bruttojahresgehalt
     *
     * @return float
     */
    public function volleRente(float $bruttojahresgehalt): float
    {
        return $this->calc($bruttojahresgehalt, self::FAKTOR_VOLL);
    }

    /**
     * @param float $bruttojahresgehalt
     *
     * @return float
     */
    public function halbeRente(float $bruttojahresgehalt): float
    {
        return $this->calc($bruttojahresgehalt, self::FAKTOR_HALB);
    }

    /**
     * @param float $gehalt
     * @param float $faktor
     *
     * @return float
     */
    private function calc(float $gehalt, float $faktor): float
    {
        return round($faktor * min($gehalt, BBG::GESETZLICHE_RENTE), 2);
    }
}
