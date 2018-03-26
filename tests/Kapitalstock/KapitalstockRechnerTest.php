<?php

namespace Finanzrechner\Tests\Kapitalstock;

use Finanzrechner\Kapitalstock\KapitalstockRechner;
use PHPUnit\Framework\TestCase;

/**
 * Class KapitalstockRechnerTest
 * @package Finanzrechner\Tests\Kapitalstock
 */
final class KapitalstockRechnerTest extends TestCase
{
    private $testcases = [
        [
            'laufzeit'     => 2,
            'entnahme'     => 2000,
            'zinssatz'     => 2,
            'kapitalstock' => 47529.41
        ],
        [
            'laufzeit'     => 23,
            'entnahme'     => 2000,
            'zinssatz'     => 3,
            'kapitalstock' => 406486
        ],
        [
            'laufzeit'     => 25,
            'entnahme'     => 999,
            'zinssatz'     => 2,
            'kapitalstock' => 238728.14
        ],
        [
            'laufzeit'     => 21,
            'entnahme'     => 2345,
            'zinssatz'     => 1.5,
            'kapitalstock' => 511265.50
        ]
    ];

    public function testCalc()
    {
        foreach ($this->testcases as $testcase) {
            $this->assertEquals($testcase['kapitalstock'],
                                (new KapitalstockRechner($testcase['zinssatz']))->calc($testcase['entnahme'], $testcase['laufzeit']));
        }
    }
}
