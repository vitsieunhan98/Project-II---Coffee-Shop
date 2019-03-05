<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_type
 * @property string $name
 * @property float $price
 * @property string $description
 * @property string $image
 * @property float $rate
 * @property int $total_rate
 * @property float $promotion_price
 * @property ProductType $productType
 * @property BillDetail[] $billDetails
 * @property Comment[] $comments
 * @property UserRate[] $userRates
 */
class Product extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product';

    /**
     * @var array
     */
    protected $fillable = ['id_type', 'name', 'price', 'description', 'image', 'rate', 'total_rate', 'promotion_price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo('App\ProductType', 'id_type', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetails()
    {
        return $this->hasMany('App\BillDetail', 'id_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'id_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRates()
    {
        return $this->hasMany('App\UserRate', 'id_product');
    }

    public static function getDrinks(){
        $drink = Product::where('id_type', 1)->get();

        return $drink;
    }

    public static function getFoods(){
        $food = Product::where('id_type', 2)->get();

        return $food;
    }

    public static function getAll(){
        $products = Product::all();

        return $products;
    }

    public static function getProduct($id){
        $product = Product::where('id', $id)->first();
        return $product;
    }
}
