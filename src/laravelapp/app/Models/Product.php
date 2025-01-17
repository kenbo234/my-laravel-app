<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
        'category_id',
        'image_id'
        
    ];

    // 論理削除のカラム名を指定（デフォルトは'deleted_at'）
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    // 出品者への評価とのリレーション
    public function sellerReviews()
    {
        return $this->hasMany(SellerReview::class, 'product_id');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function isFavorite()
    {
        // ユーザーがこの商品をお気に入りに登録しているかどうかをチェック
        return $this->favoritedByUsers->contains(auth()->user());
    }
}
