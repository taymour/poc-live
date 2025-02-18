<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Add
{
    use DefaultActionTrait;

    #[LiveProp(writable: true, url: true)]
    public int $adder = 5;

    public function getTable(): iterable
    {
        for ($i = 0; $i <= 10; $i++) {
            yield $i + $this->adder;
        }
    }

    #[LiveAction]
    public function changeAdder(#[LiveArg] int $adder): void
    {
        $this->adder = $adder;
    }
}
