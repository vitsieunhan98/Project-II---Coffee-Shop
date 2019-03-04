<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property string $date_order
 * @property float $total
 * @property string $note
 * @property boolean $status
 * @property string $address
 * @property User $user
 * @property BillDetail[] $billDetails
 */
class Bill extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['id_user', 'date_order', 'total', 'note', 'status', 'address'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetails()
    {
        return $this->hasMany('App\BillDetail', 'id_bill');
    }
}
