<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider()
    {
        return [
            [
                [
                    ["name" => "Atlanta Hartsfield International Airport"],
                    ["name" => "Austin Bergstrom International Airport"],
                    ["name" => "Boise Airport"],
                    ["name" => "Hollywood Burbank Airport"],
                ], // послали
                ['A', 'B', 'H'] // получили
            ],
        ];
    }
}
