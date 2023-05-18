<?php

namespace App\Observers;

use App\Models\Page;

class PageObserver
{
    public function creating(Page $page): void
    {
        $this->setCreator($page);
    }

    public function updating(Page $page)
    {
        $this->setEditor($page);
    }

    public function setCreator(Page $page)
    {
        $page->created_by = auth()->user()->id;
    }

    public function setEditor(Page $page)
    {
        $page->modified_by = auth()->user()->id;
    }
}
