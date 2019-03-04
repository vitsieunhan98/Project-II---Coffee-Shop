<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_comment
 * @property int $id_user
 * @property string $content
 * @property Comment $comment
 * @property User $user
 */
class ReplyComment extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'reply_comment';

    /**
     * @var array
     */
    protected $fillable = ['id_comment', 'id_user', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment', 'id_comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public static function getAll(){
        $repComments = ReplyComment::all();

        return $repComments;
    }

    public static function getReplyComment($id_comment){
        $repComment = ReplyComment::where('id_comment', $id_comment)->get();

        return $repComment;
    }
}
