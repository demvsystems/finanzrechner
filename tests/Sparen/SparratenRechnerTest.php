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
            'zinssatz'     => 3,
            'sparrate'     => 449.25
        ],
        [
            'kapitalstock' => 366124.58,
            'jahre'        => 30,
            'zinssatz'     => 1.5,
            'sparrate'     => 812.77
        ],
        [
            'kapitalstock' => 260222.29,
            'jahre'        => 18,
            'zinssatz'     => 2,
            'sparrate'     => 1012.74
        ],
        [
            'kapitalstock' => 511265.50,
            'jahre'        => 25,
            'zinssatz'     => 1.5,
            'sparrate'     => 1417.20
        ],
        [
            'kapitalstock' => 392427.36,
            'jahre'        => 0,
            'zinssatz'     => 1.5,
            'sparrate'     => 32702.28
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
