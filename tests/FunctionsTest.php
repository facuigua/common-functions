<?php
declare(strict_types=1);


namespace Tests\Cratia\Common;


use Cratia\Common\Functions;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;


class FunctionsTest extends PHPUnit_TestCase
{
    public function testPettyRunTime1()
    {
        $time = Functions::pettyRunTime(0);

        $this->assertEquals('0 ms', $time);
    }

    public function testPettyRunTime2()
    {
        $time = Functions::pettyRunTime(0.5);

        $this->assertEquals('500 ms', $time);
    }

    public function testPettyRunTime3()
    {
        $time = Functions::pettyRunTime(1);

        $this->assertEquals('1 second', $time);
    }

    public function testPettyRunTime4()
    {
        $time = Functions::pettyRunTime(2);

        $this->assertEquals('2 seconds', $time);
    }

    public function testPettyRunTime5()
    {
        $time = Functions::pettyRunTime(-2);

        $this->assertEquals('-2000 ms', $time);
    }

    public function testPettyRunTime6()
    {
        $result = Functions::formatSql("SELECT * FROM table WHERE id IN (?,?,?,?,?)", [1, true, false, null, 'test']);
        $this->assertIsString($result);
        $this->assertEquals("SELECT * FROM table WHERE id IN (1,1,0,NULL,'test')", $result);
    }

    public function testPettyRunTime7()
    {
        $result = Functions::formatSql("SELECT * FROM table WHERE id IN (:x1,:x2,:x3,:x4,:x5)", ['x1' => 1, 'x2' => true, 'x3' => false, 'x4' => null, 'x5' => '0']);
        $this->assertIsString($result);
        $this->assertEquals("SELECT * FROM table WHERE id IN (1,1,0,NULL,'0')", $result);
    }

    public function testPettyRunTime8()
    {
        $now = date("Y-m-d H:i:s");
        $result = Functions::formatSql("SELECT * FROM table WHERE id IN (:x1,:x2,:x3,:x4,:x5)", ['x1' => 1, 'x2' => true, 'x3' => false, 'x4' => null, 'x5' => $now]);
        $this->assertIsString($result);
        $this->assertEquals("SELECT * FROM table WHERE id IN (1,1,0,NULL,'{$now}')", $result);
    }
}