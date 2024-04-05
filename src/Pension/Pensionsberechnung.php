<?php

namespace Finanzrechner\Pension;

/**
 * Class BeamtenPensionRechner
 * @package Finanzrechner\Pension
 */
class Pensionsberechnung
{
    private float $pensionsbetrag;

    private bool $isMindestruhegehalt;

    public function __construct(float $pensionsbetrag, bool $isMindestruhegehalt)
    {
        $this->pensionsbetrag      = $pensionsbetrag;
        $this->isMindestruhegehalt = $isMindestruhegehalt;
    }

    public function getPensionsbetrag(): float
    {
        return $this->pensionsbetrag;
    }

    public function isMindestruhegehalt(): bool
    {
        return $this->isMindestruhegehalt;
    }
}
