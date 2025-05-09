<?php

namespace Finanzrechner\Pension;

use Exception;

use Throwable;
use function Dgame\Ensurance\ensure;

final class BeamtenPensionRechner
{
    private const PENSIONSSATZ_FAKTOR   = 1.79375;

    private const MIN_DIENSTJAHRE       = 5;

    private const MIN_PENSIONSSATZ      = 0.35;
    private const MAX_PENSIONSSATZ      = 0.7175;

    // Netto Berechnung: https://oeffentlicher-dienst.info/c/t/rechner/beamte/bund?id=beamte-bund&g=A_4&s=8&f=0&z=100&zulage=&stkl=1&r=0&zkf=0
    private const NETTO_ENDSTUFE_A4     = 3157.76;

    // FIX_BETRAG -> § 14 Abs. 4 BeamtVG https://www.gesetze-im-internet.de/beamtvg/__14.html
    private const FIX_BETRAG           = 30.68;

    private const MIN_PENSIONSSATZ_MINDESTRUHEGEHALT    = 0.65;

    /**
     * Enthält das Jahr, in dem der Kunde seinen Beamtendienst antritt
     */
    private ?int $dienstzeitbeginn = null;

    /**
     * Enthält das Jahr, in dem der Kunde seinen Beamtendienst beendet und in die
     * Pension eintritt
     */
    private ?int $pensionseintritt = null;

    /**
     * @param int $dienstzeitbeginn
     * @throws Throwable
     */
    public function setDienstzeitbeginn(int $dienstzeitbeginn): void
    {
        ensure($dienstzeitbeginn)->isPositive();
        $this->dienstzeitbeginn = $dienstzeitbeginn;
    }

    /**
     * @param int $pensionseintritt
     * @throws Throwable
     */
    public function setPensionseintritt(int $pensionseintritt): void
    {
        ensure($pensionseintritt)->isPositive();
        $this->pensionseintritt = $pensionseintritt;
    }

    public static function getMindestruhegehalt(): float
    {
        return self::NETTO_ENDSTUFE_A4 * self::MIN_PENSIONSSATZ_MINDESTRUHEGEHALT + self::FIX_BETRAG;
    }

    /**
     * Gibt die monatliche Pension zurück
     *
     * @param float $dienstbezuege
     *
     * @return Pensionsberechnung
     * @throws Throwable
     */
    public function calc(float $dienstbezuege): Pensionsberechnung
    {
        ensure($dienstbezuege)->isPositive();

        if ($this->pensionseintritt === null || $this->dienstzeitbeginn === null) {
            throw new Exception('"pensionseintritt" oder "dienstzeitbeginn" ist nicht gesetzt!');
        }

        $dienstjahre = $this->pensionseintritt - $this->dienstzeitbeginn;

        if ($dienstjahre < self::MIN_DIENSTJAHRE) {
            return new Pensionsberechnung(0, $this->pensionseintritt, false);
        }

        $pensionssatz = self::PENSIONSSATZ_FAKTOR * $dienstjahre / 100;

        $effectivePensionssatz = min([max([$pensionssatz, self::MIN_PENSIONSSATZ]), self::MAX_PENSIONSSATZ]);

        $pensionsbetrag = $dienstbezuege * $effectivePensionssatz;

        $mindestruhegehalt = self::getMindestruhegehalt();

        if ($pensionsbetrag < $mindestruhegehalt) {
            return new Pensionsberechnung($mindestruhegehalt, $this->pensionseintritt, true);
        }

        return new Pensionsberechnung($pensionsbetrag, $this->pensionseintritt, false);
    }
}
