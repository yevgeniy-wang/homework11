<?php


namespace Hillel\Homework11\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}