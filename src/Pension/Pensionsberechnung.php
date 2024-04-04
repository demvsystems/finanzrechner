<?php

namespace Finanzrechner\Pension;

/**
 * Class BeamtenPensionRechner
 * @package Finanzrechner\Pension
 */
class Pensionsberechnung
{
    private float $pensionsbetrag;

    public function getPensionsbetrag(): float
    {
        return $this->pensionsbetrag;
    }

    public function isMindestruhegehalt(): bool
    {
        return $this->isMindestruhegehalt;
    }

    private bool $isMindestruhegehalt;

    public function __construct(float $pensionsbetrag, bool $isMindestruhegehalt)
    {
        $this->pensionsbetrag      = $pensionsbetrag;
        $this->isMindestruhegehalt = $isMindestruhegehalt;
    }
}
