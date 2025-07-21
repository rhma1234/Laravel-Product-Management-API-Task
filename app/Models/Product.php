<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Enums\CurrencyEnum;
use App\Enums\ProductStatusEnum;
// use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Auth;
class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'status',
        'category_id',
        'user_id',
    ];

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

    public function tags(): belongsToMany // TODO
    {
        // TODO
        return $this->belongsToMany(Tag::class);
    }

    public function resolveRouteBinding($value, $field = null): Product
    {
        return static::withTrashed()->where($field ?? $this->getRouteKeyName(), $value)->firstOrFail();
    }

   protected static function booted()
    {

        static::updating(function ($product) {
            if (  $product->user_id !== Auth::id()) {

                throw new ModelNotFoundException('Unauthorized to update this product.');
            }
        });
    }
}
