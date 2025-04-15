<?php

namespace Finanzrechner\Tests\Rente;

use Finanzrechner\Rente\GesetzlicheRenteRechner;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class GesetzlicheRenteRechner
 * @package Finanzrechner\Tests\Rente
 */
final class GesetzlicheRenteRechnerTest extends TestCase
{
    private $testcases = [
        [
            'gehalt' => 5000 * 12,
            'alter'  => 27,
            'rente'  => 2301.71
        ],
        [
            'gehalt' => 3500 * 12,
            'alter'  => 35,
            'rente'  => 1373.97
        ],
        [
            'gehalt' => 2222 * 12,
            'alter'  => 50,
            'rente'  => 647.08
        ],
        [
            'gehalt' => 222 * 12,
            'alter'  => 50,
            'rente'  => 64.65
        ],
        [
            'gehalt' => 22222 * 12,
            'alter'  => 50,
            'rente'  => 3450
        ]
    ];

    public function testCalc()
    {
        foreach ($this->testcases as $testcase) {
            $this->assertEquals($testcase['rente'], (new GesetzlicheRenteRechner())->calc($testcase['alter'], $testcase['gehalt']));
        }
    }

    public function testWithSetters()
    {
        $rechner = new GesetzlicheRenteRechner();
        $rechner->setArbeitsbeginn(20);
        $rechner->setRenteneintritt(65);
        $rechner->setDurchschnittlicheGehaltssteigerung(3);
        $this->assertEquals(1057.85, $rechner->calc(50, 4000 * 12));
    }

    public function testCalcPossible()
    {
        $rechner = new GesetzlicheRenteRechner();
        $this->assertFalse($rechner->calcPossible(10));
        $this->assertFalse($rechner->calcPossible(70));
        $this->assertTrue($rechner->calcPossible(50));
    }

    public function testCalcNotPossible()
    {
        $this->expectException(InvalidArgumentException::class);
        (new GesetzlicheRenteRechner())->calc(10, 10);
    }
}
