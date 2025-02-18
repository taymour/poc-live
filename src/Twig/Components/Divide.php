<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Divide
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $divider;

    #[LiveProp(writable: true, url: true)]
    public int $limit = 10;

    public function getTable(): iterable
    {
        for ($i = 1; $i <= $this->limit; $i++) {
            yield round($i / $this->divider, 2);
        }
    }

    #[LiveAction]
    public function changeDivider(#[LiveArg] int $divider): void
    {
        $this->divider = $divider;
    }

    #[LiveAction]
    public function changeLimit(#[LiveArg] int $limit): void
    {
        $this->limit = $limit;
    }

    public function getUrlProps(): array
    {
        return ['divider' => $this->divider];
    }
}
