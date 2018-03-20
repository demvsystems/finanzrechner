<?php

namespace Finanzrechner\Sparen;

/**
 * Class Sparrate
 * @package Finanzrechner\Sparen
 */
final class Sparrate
{
    /**
     * @param float $kapitalstock
     * @param int   $jahre
     * @param float $zinssatz
     *
     * @return float
     */
    public static function calc(float $kapitalstock, int $jahre, float $zinssatz): float
    {
        return round($kapitalstock / self::getZinsfaktor($zinssatz, $jahre) / 12, 2);
    }

    /**
     * @param float $zinssatz
     * @param int   $jahre
     *
     * @return float
     */
    private static function getZinsfaktor(float $zinssatz, int $jahre): float
    {
        $zinsfaktor = 0;
        for ($i = 1; $i <= $jahre; $i++) {
            $zinsfaktor += pow(1 + $zinssatz, $i - 1);
        }

        return $zinsfaktor;
    }
}
