<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Navigation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $table = 'navigations';

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function editBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
