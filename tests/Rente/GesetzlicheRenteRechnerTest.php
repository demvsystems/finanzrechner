<?php

namespace Finanzrechner\Tests\Rente;

use Finanzrechner\Rente\GesetzlicheRenteRechner;
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
            'rente'  => 409
        ]
    ];

    public function testCalc()
    {
        foreach ($this->testcases as $testcase) {
            $this->assertEquals($testcase['rente'], (new GesetzlicheRenteRechner())->calc($testcase['alter'], $testcase['gehalt']));
        }
    }
}