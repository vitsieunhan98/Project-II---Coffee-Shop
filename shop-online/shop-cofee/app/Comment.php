<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property int $id_product
 * @property string $content
 * @property User $user
 * @property Product $product
 * @property ReplyComment[] $replyComments
 */
class Comment extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_product', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replyComments()
    {
        return $this->hasMany('App\ReplyComment', 'id_comment');
    }

    public static function getComment($id_product){
        $cmts = Comment::where('id_product', $id_product)->get();

        return $cmts;
    }
}
