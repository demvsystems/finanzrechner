<?php

namespace Finanzrechner\Rente;

use InvalidArgumentException;
use function Dgame\Ensurance\ensure;

/**
 * Class GesetzlicheRenteRechner
 * @package Finanzrechner\Rente
 */
final class GesetzlicheRenteRechner
{
    private const KORREKTURFAKTOR = 0.6;

    private const GRUNDSICHERUNG = 409;

    /**
     * @var int
     */
    private $arbeitsbeginn = 16;

    /**
     * @var int
     */
    private $renteneintritt = 67;

    /**
     * @var float
     */
    private $durchschnittlicheGehaltssteigerung = 2;

    /**
     * @param int $arbeitsbeginn
     */
    public function setArbeitsbeginn(int $arbeitsbeginn): void
    {
        ensure($arbeitsbeginn)->isPositive();
        $this->arbeitsbeginn = $arbeitsbeginn;
    }

    /**
     * @param int $renteneintritt
     */
    public function setRenteneintritt(int $renteneintritt): void
    {
        ensure($renteneintritt)->isPositive();
        $this->renteneintritt = $renteneintritt;
    }

    /**
     * @param float $durchschnittlicheGehaltssteigerung
     *          Die durchschnittliche Gehaltssteigerung in %
     */
    public function setDurchschnittlicheGehaltssteigerung(float $durchschnittlicheGehaltssteigerung): void
    {
        ensure($durchschnittlicheGehaltssteigerung)->isPositive();
        $this->durchschnittlicheGehaltssteigerung = $durchschnittlicheGehaltssteigerung;
    }

    /**
     * Gibt die berechnete monatliche Rente zurück
     *
     * @param int   $alter
     * @param float $bruttojahresgehalt
     *
     * @return float
     */
    public function calc(int $alter, float $bruttojahresgehalt): float
    {
        ensure($alter)->isPositive();
        ensure($bruttojahresgehalt)->isPositive();
        if (!$this->calcPossible($alter)) {
            throw new InvalidArgumentException(sprintf('Das Alter muss zwischen %s und %s liegen', $this->arbeitsbeginn, $this->renteneintritt));
        }
        $monatslohn          = $bruttojahresgehalt / 12;
        $anfangsgehalt       = $monatslohn * (1 - ($this->durchschnittlicheGehaltssteigerung / 100)) ** ($alter - $this->arbeitsbeginn);
        $endgehalt           = $monatslohn * (1 + ($this->durchschnittlicheGehaltssteigerung / 100)) ** ($this->renteneintritt - $alter);
        $durchschnittsgehalt = ($anfangsgehalt + $endgehalt) / 2;

        $rente = ($durchschnittsgehalt / 100) * ($this->renteneintritt - $this->arbeitsbeginn) * self::KORREKTURFAKTOR;

        return round(max($rente, self::GRUNDSICHERUNG), 2);
    }

    /**
     * @param int $alter
     *
     * @return bool
     */
    public function calcPossible(int $alter): bool
    {
        return $alter >= $this->arbeitsbeginn && $alter <= $this->renteneintritt;
    }
}
