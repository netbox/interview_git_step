<?php

declare(strict_types=1);

use App\Brackets;
use PHPUnit\Framework\TestCase;


class BracketsTest extends TestCase
{
    private Brackets $checker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checker = new Brackets();
    }

    /**
     * @dataProvider bracketsValidProvider
     */
    public function testSuccessCheckBrackets(string $line): void
    {
        self::assertTrue($this->checker->check($line), "Input line: $line");
    }

    /**
     * @dataProvider bracketsInvalidProvider
     */
    public function testFailCheckBrackets(string $line): void
    {
        self::assertFalse($this->checker->check($line), "Input line: $line");
    }

    public function bracketsValidProvider(): Generator
    {
        $items = [
            '()',
            '(())',
            '(())()',
        ];
        foreach ($items as $item) {
            yield [$item];
        }
    }

    public function bracketsInvalidProvider(): Generator
    {
        $items = [
            '(()',
            ')(',
            '()((',
        ];
        foreach ($items as $item) {
            yield [$item];
        }
    }
}
