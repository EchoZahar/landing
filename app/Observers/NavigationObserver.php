<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Navigation;

class NavigationObserver
{
    public function creating(Navigation $nav)
    {
        $this->setCreator($nav);
        $this->setSlug($nav);
    }

    public function updating(Navigation $nav)
    {

    }

    public function setSlug(Navigation $nav)
    {
        $nav->slug = Str::slug($nav->name, '_');
    }

    public function setCreator(Navigation $nav)
    {
        $nav->creator = auth()->user()->id;
    }

    public function setEditor(Navigation $nav)
    {
        $nav->editor = auth()->user()->id;
    }
}
