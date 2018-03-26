<?php

namespace Finanzrechner\Tests\Rente;

use Finanzrechner\Rente\ErwerbsminderungsrenteRechner;
use PHPUnit\Framework\TestCase;

/**
 * Class ErwerbsminderungsrenteRechner
 * @package Finanzrechner\Tests\Rente
 */
final class ErwerbsminderungsrenteRechnerTest extends TestCase
{
    private $testcases = [
        [
            'gehalt' => 5000 * 12,
            'voll'   => 17400,
            'halb'   => 9000,
        ],
        [
            'gehalt' => 3500 * 12,
            'voll'   => 12180,
            'halb'   => 6300,
        ],
        [
            'gehalt' => 10000 * 12,
            'voll'   => 21402,
            'halb'   => 11070,
        ],
    ];

    public function testCalc()
    {
        foreach ($this->testcases as $testcase) {
            $this->assertEquals($testcase['voll'], (new ErwerbsminderungsrenteRechner())->volleRente($testcase['gehalt']));
            $this->assertEquals($testcase['halb'], (new ErwerbsminderungsrenteRechner())->halbeRente($testcase['gehalt']));
        }
    }
}
