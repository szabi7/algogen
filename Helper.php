<?php

class Helper
{
    public static function random_float($min = 0, $max = 1) {
        return random_int($min, $max - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX );
    }
}
