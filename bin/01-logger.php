<?php

declare(strict_types=1);

class DateFormatter
{
    public function format(DateTime $date): string
    {
        return $date->format('Y-m-d');
    }

    public function getField(): string
    {
        return 'date';
    }
}

class SimpleLogger
{
    private array $formatters;

    public function __construct(iterable $formatters)
    {
        $this->formatters = $formatters instanceof Traversable ? iterator_to_array($formatters) : $formatters;
    }

    public function __invoke($fromValue, $fromCurrency, $toValue, $toCurrency, $date): string
    {
        foreach ($this->formatters as $formatter) {
            if ($formatter->getField() === 'date') {
                $date = $formatter->format($date);
            }
        }

        return "[{$date}] {$fromValue}/{$fromCurrency} => {$toValue}/{$toCurrency}";
    }
}

$operations = [
    [5, 'USD', 0.2, 'BTC', '2022-01-02'],
    [5, 'AED', 76, 'EUR', '2018-08-29'],
    [6000, 'KZT', 12, 'USD', '2016-05-08'],
];

$builder = new SimpleLogger([new DateFormatter()]);
foreach ($operations as $operation) {
    echo $builder(
            $operation[0],
            $operation[1],
            $operation[2],
            $operation[3],
            DateTime::createFromFormat('Y-m-d', $operation[4]),
        ) . PHP_EOL;
}
