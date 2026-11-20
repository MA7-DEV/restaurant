<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ✅ دالة ذكية لمعرفة رابط الصورة (سواء كانت من النت أو مرفوعة على السيرفر)
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // لو الصورة رابط خارجي (http)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // لو الصورة ملف مرفوع على السيرفر
        return asset('storage/' . $this->image);
    }
}