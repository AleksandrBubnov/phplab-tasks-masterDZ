<?php

namespace src\oop\Commands;

class PowerCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }
        return pow($args[0], $args[1]);
    }
}
