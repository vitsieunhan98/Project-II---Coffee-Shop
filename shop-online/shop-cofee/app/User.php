<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
/**
 * @property int $id
 * @property int $id_role
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property boolean $status
 * @property Role $role
 * @property Bill[] $bills
 * @property Comment[] $comments
 * @property ReplyComment[] $replyComments
 */
class User extends \Eloquent implements Authenticatable
{
    use AuthenticableTrait;
    public $timestamps = false;
    public $remember_token=false;
    /**
     * @var array
     */
    protected $fillable = ['id_role', 'name', 'email', 'password', 'phone', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'id_role', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany('App\Bill', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replyComments()
    {
        return $this->hasMany('App\ReplyComment', 'id_user');
    }

    public static function getAll(){
        $users = User::all();

        return $users;
    }
}
