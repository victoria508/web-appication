<?php

namespace Brainr\Policies;

use Brainr\Collection;
use Brainr\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * @param \Brainr\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * @param \Brainr\User       $user
     * @param \Brainr\Collection $collection
     *
     * @return mixed
     */
    public function read(User $user, Collection $collection)
    {
        return $collection->owner->is($user);
    }

    /**
     * @param \Brainr\User       $user
     * @param \Brainr\Collection $collection
     *
     * @return mixed
     */
    public function update(User $user, Collection $collection)
    {
        return $collection->owner->is($user);
    }

    /**
     * @param \Brainr\User       $user
     * @param \Brainr\Collection $collection
     *
     * @return mixed
     */
    public function delete(User $user, Collection $collection)
    {
        return $collection->owner->is($user);
    }
}
