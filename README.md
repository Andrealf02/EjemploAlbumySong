# Laravel Like

👍 User-like features for Laravel Application.

![CI](https://github.com/overtrue/laravel-like/workflows/CI/badge.svg)

[![Sponsor me](https://github.com/overtrue/overtrue/blob/master/sponsor-me-button-s.svg?raw=true)](https://github.com/sponsors/overtrue)

## Installing

```shell
composer require overtrue/laravel-like -vvv
```

### Configuration

This step is optional

```php
php artisan vendor:publish
```

### Migrations

This step is also optional, if you want to custom likes table, you can publish the migration files:

```php
php artisan vendor:publish
```

## Usage

### Traits

#### `Overtrue\LaravelLike\Traits\Liker`

```php

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable
{
    use Liker;

    <...>
}
```

#### `Overtrue\LaravelLike\Traits\Likeable`

```php
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Post extends Model
{
    use Likeable;

    <...>
}
```

### API

```php
$user = User::find(1);
$post = Post::find(2);

$user->like($post);
$user->unlike($post);
$user->toggleLike($post);

$user->hasLiked($post);
$post->isLikedBy($user);
```

Get user likes with pagination:

```php
$likes = $user->likes()->with('likeable')->paginate(20);

foreach ($likes as $like) {
    $like->likeable; // App\Post instance
}
```

Get object likers:

```php
foreach($post->likers as $user) {
    // echo $user->name;
}
```

with pagination:

```php
$likers = $post->likers()->paginate(20);

foreach($likers as $user) {
    // echo $user->name;
}
```

### Aggregations

```php
// all
$user->likes()->count();

// with type
$user->likes()->withType(Post::class)->count();

// likers count
$post->likers()->count();
```

List with `*_count` attribute:

```php
// likes_count
$users = User::withCount('likes')->get();

foreach($users as $user) {
    // $user->likes_count;
}

// likers_count
$posts = User::withCount('likers')->get();

foreach($posts as $post) {
    // $post->likes_count;
}
```

### N+1 issue

To avoid the N+1 issue, you can use eager loading to reduce this operation to just 2 queries. When querying, you may specify which relationships should be eager loaded using the `with` method:

```php
// Liker
$users = App\User::with('likes')->get();

foreach($users as $user) {
    $user->hasLiked($post);
}

// Likeable
$posts = App\Post::with('likes')->get();
// or
$posts = App\Post::with('likers')->get();

foreach($posts as $post) {
    $post->isLikedBy($user);
}
```

Of course we have a better solution, which can be found in the following section：

### Attach user like status to likeable collection

You can use `Liker::attachLikeStatus($likeables)` to attach the user like status, it will attach `has_liked` attribute to each model of `$likeables`:

#### For model
```php
$post = Post::find(1);

$post = $user->attachLikeStatus($post);

// result
[
    "id" => 1
    "title" => "Add socialite login support."
    "created_at" => "2021-05-20T03:26:16.000000Z"
    "updated_at" => "2021-05-20T03:26:16.000000Z"
    "has_liked" => true
 ],
```

#### For `Collection | Paginator | LengthAwarePaginator | array`:

```php
$posts = Post::oldest('id')->get();

$posts = $user->attachLikeStatus($posts);

$posts = $posts->toArray();

// result
[
  [
    "id" => 1
    "title" => "Post title1"
    "created_at" => "2021-05-20T03:26:16.000000Z"
    "updated_at" => "2021-05-20T03:26:16.000000Z"
    "has_liked" => true
  ],
  [
    "id" => 2
    "title" => "Post title2"
    "created_at" => "2021-05-20T03:26:16.000000Z"
    "updated_at" => "2021-05-20T03:26:16.000000Z"
    "has_liked" => fasle
  ],
  [
    "id" => 3
    "title" => "Post title3"
    "created_at" => "2021-05-20T03:26:16.000000Z"
    "updated_at" => "2021-05-20T03:26:16.000000Z"
    "has_liked" => true
  ],
]
```

#### For pagination

```php
$posts = Post::paginate(20);

$user->attachLikeStatus($posts);
```

### Events

| **Event**                             | **Description**                             |
| ------------------------------------- | ------------------------------------------- |
| `Overtrue\LaravelLike\Events\Liked`   | Triggered when the relationship is created. |
| `Overtrue\LaravelLike\Events\Unliked` | Triggered when the relationship is deleted. |
