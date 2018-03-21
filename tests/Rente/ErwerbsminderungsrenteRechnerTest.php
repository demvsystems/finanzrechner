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
            'voll'   => 28800,
            'halb'   => 14400,
        ],
        [
            'gehalt' => 3500 * 12,
            'voll'   => 20160,
            'halb'   => 10080,
        ],
        [
            'gehalt' => 10000 * 12,
            'voll'   => 35424,
            'halb'   => 17712,
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
