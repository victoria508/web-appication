<?php

namespace Brainr\Policies;

use Brainr\Profile;
use Brainr\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * @param  \Brainr\User  $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * @param  \Brainr\User  $user
     * @param  \Brainr\Profile  $profile
     *
     * @return bool
     */
    public function read(User $user, Profile $profile)
    {
        return $profile->owner->is($user);
    }

    /**
     * @param  \Brainr\User  $user
     * @param  \Brainr\Profile  $profile
     *
     * @return bool
     */
    public function update(User $user, Profile $profile)
    {
        return $profile->owner->is($user);
    }

    /**
     * @param  \Brainr\User  $user
     * @param  \Brainr\Profile  $profile
     *
     * @return bool
     */
    public function delete(User $user, Profile $profile)
    {
        return $profile->owner->is($user);
    }
}
