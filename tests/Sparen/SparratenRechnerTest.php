<?php

namespace Finanzrechner\Tests\Sparen;

use Finanzrechner\Sparen\SparratenRechner;
use PHPUnit\Framework\TestCase;

/**
 * Class SparratenRechnerTest
 * @package Finanzrechner\Sparen
 */
final class SparratenRechnerTest extends TestCase
{
    private $testValues = [
        [
            'kapitalstock' => 406486.00,
            'jahre'        => 40,
            'zinssatz'     => 0.03,
            'sparrate'     => 449.25
        ],
        [
            'kapitalstock' => 366124.58,
            'jahre'        => 30,
            'zinssatz'     => 0.015,
            'sparrate'     => 812.77
        ],
        [
            'kapitalstock' => 260222.29,
            'jahre'        => 18,
            'zinssatz'     => 0.02,
            'sparrate'     => 1012.74
        ],
        [
            'kapitalstock' => 511265.50,
            'jahre'        => 25,
            'zinssatz'     => 0.015,
            'sparrate'     => 1417.20
        ],
    ];

    /**
     *
     */
    public function testCalc()
    {
        foreach ($this->testValues as $testValue) {
            $sparratenRechner = new SparratenRechner($testValue['zinssatz']);
            $this->assertEquals($testValue['sparrate'], $sparratenRechner->calc($testValue['kapitalstock'], $testValue['jahre']));
        }
    }
}
