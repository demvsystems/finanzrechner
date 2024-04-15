<?php

namespace Finanzrechner\Pension;

/**
 * Class BeamtenPensionRechner
 * @package Finanzrechner\Pension
 */
class Pensionsberechnung implements \JsonSerializable
{
    private float $pensionsbetrag;

    private float $pensionseintritt;

    private bool $isMindestruhegehalt;

    public function __construct(float $pensionsbetrag, float $pensionseintritt, bool $isMindestruhegehalt)
    {
        $this->pensionsbetrag      = $pensionsbetrag;
        $this->pensionseintritt   = $pensionseintritt;
        $this->isMindestruhegehalt = $isMindestruhegehalt;
    }

    public function getPensionsbetrag(): float
    {
        return $this->pensionsbetrag;
    }

    public function getPensionseintritt(): float
    {
        return $this->pensionseintritt;
    }

    public function isMindestruhegehalt(): bool
    {
        return $this->isMindestruhegehalt;
    }

    public function jsonSerialize(): array
    {
        return [
            'pensionsbetrag'      => $this->pensionsbetrag,
            '$pensionseintritt'   => $this->pensionseintritt,
            'isMindestruhegehalt' => $this->isMindestruhegehalt
        ];
    }
}
