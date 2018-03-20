<?php

namespace Finanzrechner\Sparen;

/**
 * Class SparratenRechner
 * @package Finanzrechner\Sparen
 */
final class SparratenRechner
{
    /**
     * @var float
     */
    private $zinssatz;

    /**
     * @var
     */
    private $sparrate;

    /**
     * SparratenRechner constructor.
     *
     * @param float $zinssatz
     */
    public function __construct(float $zinssatz)
    {
        $this->zinssatz = $zinssatz;
    }

    /**
     * @param float $kapitalstock
     * @param int   $jahre
     *
     * @return float
     */
    public function calc(float $kapitalstock, int $jahre): float
    {
        return round($this->sparrate = $kapitalstock / $this->getZinsfaktor($jahre) / 12, 2);
    }

    /**
     * @param int $jahre
     *
     * @return float
     */
    private function getZinsfaktor(int $jahre): float
    {
        $zinsfaktor = 0;
        for ($i = 1; $i <= $jahre; $i++) {
            $zinsfaktor += (1 + $this->zinssatz) ** ($i - 1);
        }

        return $zinsfaktor;
    }
}
