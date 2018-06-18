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

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->rechner = new KrankentagegeldRechner();
    }

    public function testBrutto()
    {
        $this->assertEquals(35000 * 0.88, $this->rechner->calc(50000, 40000));
    }

    public function testNegativeBrutto()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(-50000, 35000);
    }

    public function testNetto()
    {
        $this->assertEquals(18000 * 0.88, $this->rechner->calc(50000, 20000));
    }

    public function testBruttoNotSet()
    {
        $this->assertEquals(18000 * 0.88, $this->rechner->calc(0, 20000));
    }

    public function testNettoNotSet()
    {
        $this->assertEquals(35000 * 0.88, $this->rechner->calc(50000, 0));
    }

    public function testNegativeNetto()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(50000, -35000);
    }

    public function testBBG()
    {
        $this->assertEquals(37170 * 0.88, $this->rechner->calc(100000, 80000));
    }
}
