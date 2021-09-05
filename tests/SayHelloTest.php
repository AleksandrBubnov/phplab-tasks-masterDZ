<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider1
     */
    public function testPositive1($input, $expected)
    {
        $this->assertEquals($expected, sayHello($input));
    }

    public function positiveDataProvider1()
    {
        return [
            'empty_str' => ['', 'Hello'], // послали, получили
            'null_val' => [null, 'Hello'], // послали, получили
        ];
    }

    public function testPositive2()
    {
        $expected = 'Hello';
        $this->assertEquals($expected, sayHello());
    }
}
