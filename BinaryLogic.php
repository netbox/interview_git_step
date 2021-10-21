<?php

declare(strict_types=1);


function provider(): Generator
{
    yield 0b111;
    yield 0b101;
}

foreach (provider() as $value) {
    echo($value & 0b111) . PHP_EOL;
}

foreach (provider() as $value) {
    echo($value ^ (0x1 << 1)) . PHP_EOL;
}
