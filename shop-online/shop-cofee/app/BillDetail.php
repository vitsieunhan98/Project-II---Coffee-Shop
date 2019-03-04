<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_bill
 * @property int $id_product
 * @property int $quantity
 * @property float $unit_price
 * @property Bill $bill
 * @property Product $product
 */
class BillDetail extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'bill_detail';

    /**
     * @var array
     */
    protected $fillable = ['id_bill', 'id_product', 'quantity', 'unit_price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo('App\Bill', 'id_bill');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product');
    }

}
