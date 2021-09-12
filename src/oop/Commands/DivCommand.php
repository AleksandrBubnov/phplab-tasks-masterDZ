<?php

namespace src\oop\Commands;

class DivCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }
        if (0 == $args[1]) {
            throw new \InvalidArgumentException('0 == $args[1]');
        }

        return $args[0] / $args[1];
    }
}
