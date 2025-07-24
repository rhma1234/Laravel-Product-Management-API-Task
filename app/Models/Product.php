<?php

namespace App\Models;

use App\Enums\CurrencyEnum;
use App\Enums\ProductStatusEnum;
// use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

// #[UsePolicy(ProductPolicy::class)]
class Product extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'status',
        'category_id',
        'user_id',
    ];

    public const MEDIA_COLLECTION_IMAGES = 'images';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'currency' => CurrencyEnum::class,
        'status' => ProductStatusEnum::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);

    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function syncTags(?array $tagIds = []): void
    {
        if (empty($tagIds)) {
            return;
        }

        $this->tags()->sync($tagIds);
    }

    // public function resolveRouteBinding($value, $field = null): Product
    // {
    //     return static::withTrashed()->where($field ?? $this->getRouteKeyName(), $value)->firstOrFail();
    // }

    protected static function booted() {}
}
