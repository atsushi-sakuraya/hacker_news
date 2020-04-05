<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property string|null $article_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'post_id',
        'thread_id',
        'user_id',
        'comment',
        'article_url',
        'image0',
        'image1',
        'image2',
        'image3'
    ];

    /**
     * 投稿のユーザ情報を取得
     */
    public function user()
    {
        return $this->belongsTo('App\Domain\Entity\User');
    }
}
