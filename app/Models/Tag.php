<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations;

    protected $fillable = ['name'];

    public $translatable = ['name'];
    // protected $casts = [
    //     'name' => 'array',
    // ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
