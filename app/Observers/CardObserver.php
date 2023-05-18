<?php

namespace App\Observers;

use App\Models\Card;

class CardObserver
{
    public function creating(Card $card): void
    {
        $this->setCreator($card);
    }

    public function updating(Card $card): void
    {
        $this->setEditor($card);
    }

    public function setCreator(Card $card)
    {
        $card->creator = auth()->user()->id;
    }

    public function setEditor(Card $card)
    {
        $card->editor = auth()->user()->id;
    }
}
