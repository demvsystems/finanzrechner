<?php

namespace Finanzrechner\Pension;

use function Dgame\Ensurance\ensure;

use Exception;

/**
 * Class BeamtenPensionRechner
 * @package Finanzrechner\Rente
 */
final class BeamtenPensionRechner
{
    private const PENSIONSSATZ_FAKTOR   = 1.79375;

    private const MIN_DIENSTJAHRE       = 5;

    private const MIN_PENSIONSSATZ      = 0.35;
    private const MAX_PENSIONSSATZ      = 0.7175;

    /**
     * Enthält das Jahr in dem der Kunde seinen Beamtendienst antritt
     * @var int|null
     */
    private $dienstzeitbeginn = null;

    /**
     * Enthält das Jahr, in dem der Kunde seinen Beamtendienst beendet und in die
     * Pension eintritt
     * @var int
     */
    private $pensionseintritt = null;

    /**
     * @param int $dienstzeitbeginn
     */
    public function setDienstzeitbeginn(int $dienstzeitbeginn): void
    {
        ensure($dienstzeitbeginn)->isPositive();
        $this->dienstzeitbeginn = $dienstzeitbeginn;
    }

    /**
     * @param int $pensionseintritt
     */
    public function setPensionseintritt(int $pensionseintritt): void
    {
        ensure($pensionseintritt)->isPositive();
        $this->pensionseintritt = $pensionseintritt;
    }

    /**
     * Gibt die monatliche Pension zurück
     *
     * @param float $dienstbezuege
     *
     * @return float
     */
    public function calc(float $dienstbezuege): float
    {
        ensure($dienstbezuege)->isPositive();

        if ($this->pensionseintritt === null || $this->dienstzeitbeginn === null) {
            throw new Exception('"pensionseintritt" oder "dienstzeitbeginn" ist nicht gesetzt!');
        }

        $dienstjahre = $this->pensionseintritt - $this->dienstzeitbeginn;

        if ($dienstjahre < self::MIN_DIENSTJAHRE) {
            return 0;
        }

        $pensionssatz = self::PENSIONSSATZ_FAKTOR * $dienstjahre / 100;

        if ($pensionssatz <= self::MIN_PENSIONSSATZ) {
            return $dienstbezuege * self::MIN_PENSIONSSATZ;
        } else if ($pensionssatz >= self::MAX_PENSIONSSATZ) {
            return $dienstbezuege * self::MAX_PENSIONSSATZ;
        }

        return $dienstbezuege * $pensionssatz;
    }
}
