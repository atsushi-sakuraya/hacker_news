<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Domain\Entity{
/**
 * App\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property string|null $article_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereArticleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Domain\Entity{
/**
 * App\Domain\Entity\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $profile_icon_photo
 * @property string|null $profile_header_photo
 * @property string|null $self_produce
 * @property int $birth_year
 * @property int $birth_month
 * @property int $birth_day
 * @property int $follow
 * @property int $follower
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereBirthDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereBirthMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereFollower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereProfileHeaderPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereProfileIconPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereSelfProduce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain\Entity\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Domain\Entity{
/**
 * App\Image
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUserId($value)
 * @mixin \Eloquent
 */
	class Image extends \Eloquent {}
}

