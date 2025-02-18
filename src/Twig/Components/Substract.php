<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Substract
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $first;

    #[LiveProp(writable: true, url: true)]
    public int $second = 1;

    public function getResult(): int
    {
        return $this->first - $this->second;
    }

    #[LiveAction]
    public function changeNumbers(#[LiveArg] int $first, #[LiveArg] int $second): void
    {
        $this->first = $first;
        $this->second = $second;
    }

    public function getUrlProps(): array
    {
        return ['first' => $this->first];
    }
}
