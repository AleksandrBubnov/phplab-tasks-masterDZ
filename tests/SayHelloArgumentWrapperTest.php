<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHelloArgumentWrapper($input));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        sayHelloArgumentWrapper(NULL);
    }

    public function positiveDataProvider()
    {
        return [
            [1, 'Hello 1'],
        ];
    }
}
