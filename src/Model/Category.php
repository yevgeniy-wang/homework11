<?php


namespace Hillel\Homework11\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}