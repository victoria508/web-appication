<?php

namespace Brainr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['path', 'filename', 'filesize'];


    /**
     * @var array
     */
    protected $visible = ['path', 'filename', 'filesize'];

    /**
     * Relations to its profile
     *
     * @return BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
