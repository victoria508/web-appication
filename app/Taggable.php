<?php

namespace Brainr;

trait Taggable
{
    /**
     * Tag relation
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
