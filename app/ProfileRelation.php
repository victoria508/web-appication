<?php

namespace Brainr;

use Illuminate\Database\Eloquent\Model;

class ProfileRelation extends Model
{
    use Taggable;

    /**
     * @var array
     */
    protected $visible = ['name', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The profiles that are linked
     *
     * @return mixed
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * @param $profile
     *
     * @return mixed
     */
    public function other($profile)
    {
        $profile = $profile instanceof Profile ? $profile->id : $profile;

        return $this->profiles()
                    ->where('id', '!=', $profile);
    }
}
