<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $table = 'seo';

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
