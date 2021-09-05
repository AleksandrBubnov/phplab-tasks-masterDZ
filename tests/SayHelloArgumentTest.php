<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            [1, 'Hello 1'],
            [5, 'Hello 5'],
            ['string_value', 'Hello string_value'],
            [true, 'Hello 1'],
            [false, 'Hello '],
        ];
    }
}
