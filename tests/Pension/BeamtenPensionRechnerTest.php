<?php

namespace Finanzrechner\Tests\Pension;

use Dgame\Ensurance\Exception\EnsuranceException;
use Exception;
use Finanzrechner\Pension\BeamtenPensionRechner;
use PHPUnit\Framework\TestCase;

/**
 * Class BeamtenPensionRechner
 * @package Finanzrechner\Tests\Pension
 */
final class BeamtenPensionRechnerTest extends TestCase
{
    /** @var BeamtenPensionRechner $rechner */
    private $rechner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rechner = new BeamtenPensionRechner();
    }

    public function testCalcNoPension()
    {
        // Bei weniger als fünf Jahren Dienstzeit wird keine Pension gezahlt
        $this->rechner->setDienstzeitbeginn(2000);
        $this->rechner->setPensionseintritt(2004);

        $result = $this->rechner->calc(1000);

        $this->assertEquals(0, $result->pensionsbetrag);
        $this->assertFalse($result->isMindestruhegehalt);
    }

    public function testCalcMinimumPension()
    {
        // Bei weniger als 20 Jahren Dienstzeit errechnet sich ein Pensionssatz von
        // weniger als 35% -> Minimum der Pension ist immer 35% von den Dienstbezügen
        $this->rechner->setDienstzeitbeginn(2000);
        $this->rechner->setPensionseintritt(2010);

        // Beachten, dass diese calculation der Pension nicht im Mindestruhegehalt endet, also Dienstbezüge
        // hoch genug ist
        $result = $this->rechner->calc(6000);

        $this->assertEquals(0.35 * 6000, $result->pensionsbetrag);
        $this->assertFalse($result->isMindestruhegehalt);
    }

    public function testCalcMaximumPension()
    {
        // Nach 40+ Jahren Dienstzeit errechnet sich ein Pensionssatz von größer als
        // 71.75 % -> Maximum der Pension ist 71.75% von den Dienstbezügen
        $this->rechner->setDienstzeitbeginn(2000);
        $this->rechner->setPensionseintritt(2041);

        // Beachten, dass diese calculation der Pension nicht im Mindestruhegehalt endet, also Dienstbezüge
        // hoch genug ist
        $result = $this->rechner->calc(4000);

        $this->assertEquals(0.7175 * 4000, $result->pensionsbetrag);
        $this->assertFalse($result->isMindestruhegehalt);
    }

    public function testCalcPension()
    {
        $this->rechner->setDienstzeitbeginn(2000);
        $this->rechner->setPensionseintritt(2025);

        // Pensionssatz-Faktor * Anzahl Dienstjahre / 100 * Dienstbezüge
        $result  = $this->rechner->calc(4000);
        $pension = 1.79375 * 25 / 100 * 4000;

        $this->assertEquals($pension, $result->pensionsbetrag);
        $this->assertFalse($result->isMindestruhegehalt);
    }

    public function testThrowsIfDienstzeitOrPensionseintrittNotSet()
    {
        $this->expectException(Exception::class);
        $this->rechner->calc(1000);
    }

    public function testThrowsIfDienstbezuegeIsNegative()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(-1000);
    }

    public function testThrowsIfDienstzeitbeginnIsNegative()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->setDienstzeitbeginn(-1);
    }

    public function testThrowsIfPensionseintrittIsNegative()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->setPensionseintritt(-1);
    }

    public function testPensionIsMinRuhegehalt()
    {
        // ist das amtsabhängige Mindestruhegehalt kleiner als das amtsunabhängige Mindestruhegehalt sollte
        // $result->pensionsbetrag === $minRuhegehalt sein und isMindestruhegehalt = true
        $this->rechner->setDienstzeitbeginn(2000);
        $this->rechner->setPensionseintritt(2025);

        $result        = $this->rechner->calc(1000);
        $minRuhegehalt = BeamtenPensionRechner::mindestruhegehalt();

        $this->assertEquals($minRuhegehalt, $result->pensionsbetrag);
        $this->assertTrue($result->isMindestruhegehalt);
    }
}
