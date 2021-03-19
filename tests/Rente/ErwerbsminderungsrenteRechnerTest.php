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
            'voll'   => 22800,
            'halb'   => 10800,
        ],
        [
            'gehalt' => 3500 * 12,
            'voll'   => 15960,
            'halb'   => 7560,
        ],
        [
            'gehalt' => 10000 * 12,
            'voll'   => 31464,
            'halb'   => 14904,
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
