<?php

namespace Finanzrechner\Tests\Krankentagegeld;

use Dgame\Ensurance\Exception\EnsuranceException;
use Finanzrechner\Krankentagegeld\KrankentagegeldRechner;
use PHPUnit\Framework\TestCase;

/**
 * Class KrankentagegeldRechner
 * @package Finanzrechner\Tests\Krankentagegeld
 */
final class KrankentagegeldRechnerTest extends TestCase
{
    /**
     * @var KrankentagegeldRechner
     */
    private $rechner;

    protected function setUp(): void
    {
        $this->rechner = new KrankentagegeldRechner();
    }

    public function testBrutto(): void
    {
        $this->assertEquals(35000 * 0.88, $this->rechner->calc(50000, 40000));
    }

    public function testNegativeBrutto(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(-50000, 35000);
    }

    public function testNetto(): void
    {
        $this->assertEquals(18000 * 0.88, $this->rechner->calc(50000, 20000));
    }

    public function testBruttoNotSet(): void
    {
        $this->assertEquals(18000 * 0.88, $this->rechner->calc(0, 20000));
    }

    public function testNettoNotSet(): void
    {
        $this->assertEquals(35000 * 0.88, $this->rechner->calc(50000, 0));
    }

    public function testNegativeNetto(): void
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(50000, -35000);
    }

    public function testBBG(): void
    {
        $this->assertEquals(40635 * 0.88, $this->rechner->calc(100000, 80000));
    }
}
