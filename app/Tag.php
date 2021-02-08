<?php

namespace Brainr;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    /**
     * @var string[]
     */
    protected $visible = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profileRelations()
    {
        return $this->belongsToMany(ProfileRelation::class);
    }
}
