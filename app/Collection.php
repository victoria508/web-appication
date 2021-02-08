<?php

namespace Brainr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes, Ownable;

    /**
     * @var array
     */
    protected $visible = ['name', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rootprofile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Profiles in this collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profileRelation()
    {
        return $this->hasMany(ProfileRelation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
