<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    public function testPositive_no_arguments()
    {
        $expected = [
            'argument_count'  => 0,
            'argument_values' => [],
        ];
        $this->assertEquals($expected, countArguments());
    }

    /**
     * @dataProvider positiveDataProvider_one_arguments
     */
    public function testPositive_one_arguments($input, $expected)
    {
        $this->assertEquals($expected, countArguments($input));
    }

    /**
     * @dataProvider positiveDataProvider_two_arguments
     */
    public function testPositive_two_arguments($input1, $input2, $expected)
    {
        $this->assertEquals($expected, countArguments($input1, $input2));
    }

    public function positiveDataProvider_one_arguments()
    {
        return [
            'one_arg' => [
                'one arg',
                [
                    'argument_count'  => 1,
                    'argument_values' => ['one arg'],
                ]
            ],
        ];
    }

    public function positiveDataProvider_two_arguments()
    {
        return [
            // 'null_arg' => [
            //     null,
            //     [
            //         'argument_count'  => 1,
            //         'argument_values' => [null],
            //     ]
            // ],
            // 'one_arg' => [
            //     'one arg',
            //     [
            //         'argument_count'  => 1,
            //         'argument_values' => ['one arg'],
            //     ]
            // ],
            'two_arg' => [
                'two',
                'args',
                [
                    'argument_count'  => 2,
                    'argument_values' => ['two', 'args'],
                ]
            ],
        ];
    }
}
