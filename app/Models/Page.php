<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    public $table = 'pages';

    protected $guarded = [];

    public function contactForms(): HasMany
    {
        return $this->hasMany(ContactForm::class, 'page_id');
    }

    public function navigations(): HasMany
    {
        return $this->hasMany(Navigation::class, 'page_id');
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class, 'page_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
