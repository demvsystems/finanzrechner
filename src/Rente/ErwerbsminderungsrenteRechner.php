<?php

namespace Finanzrechner\Rente;

use Demv\Werte\Beitragsbemessung\BBG;

/**
 * Class ErwerbsminderungsrenteRechner
 * @package Finanzrechner\Rente
 */
final class ErwerbsminderungsrenteRechner
{
    private const FAKTOR_VOLL = 0.48;
    private const FAKTOR_HALB = 0.24;

    /**
     * @param float $nettojahresgehalt
     *
     * @return float
     */
    public function volleRente(float $nettojahresgehalt): float
    {
        return $this->calc($nettojahresgehalt, self::FAKTOR_VOLL);
    }

    /**
     * @param float $nettojahresgehalt
     *
     * @return float
     */
    public function halbeRente(float $nettojahresgehalt): float
    {
        return $this->calc($nettojahresgehalt, self::FAKTOR_HALB);
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
