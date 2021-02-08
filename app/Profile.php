<?php

namespace Brainr;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Taggable, Ownable;

    /**
     * @var array
     */
    protected $visible = ['id', 'name', 'description', 'content', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'content'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Relations to other profiles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relations()
    {
        return $this->belongsToMany(ProfileRelation::class);
    }

    /**
     * Relations to other profiles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
