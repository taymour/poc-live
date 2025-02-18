<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Multiply
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $factor;

    public function getTable(): iterable
    {
        for ($i = 0; $i <= 10; $i++) {
            yield $i * $this->factor;
        }
    }

    #[LiveAction]
    public function changeFactor(#[LiveArg] int $factor): void
    {
        $this->factor = $factor;
    }

    public function getUrlProps(): array
    {
        return ['factor' => $this->factor];
    }
}
