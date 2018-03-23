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
        $this->assertEquals(35000, $this->rechner->calc(50000, 40000));
    }

    public function testNegativeBrutto()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(-50000, 35000);
    }

    public function testNetto()
    {
        $this->assertEquals(18000, $this->rechner->calc(50000, 20000));
    }

    public function testNegativeNetto()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(50000, -35000);
    }

    public function testNettoGreaterBrutto()
    {
        $this->expectException(EnsuranceException::class);
        $this->rechner->calc(50000, 60000);
    }

    public function testBBG()
    {
        $this->assertEquals(37170, $this->rechner->calc(100000, 80000));
    }
}
