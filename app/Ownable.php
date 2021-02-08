<?php

namespace Brainr;

trait Ownable
{
    /**
     * Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }
}
