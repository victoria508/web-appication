<?php

namespace Brainr\Http\Controllers\Api;

use Brainr\Http\Controllers\Controller;
use Brainr\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * CollectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Displays all profiles owned by the user
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $request->user()->profiles;
    }

    /**
     * Stores a new profile
     * TODO: Allow tags to be stored
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->authorize('create', Profile::class);

        $request->validate([
            'name' => ['required', 'max:100'],
            'description' => ['sometimes', 'nullable', 'string'],
            'content' => ['sometimes', 'nullable', 'string'],
        ]);

        $profile = $request->user()
                           ->profiles()
                           ->create($request->all());

        return response($profile, 201, [
            'Content-Location' => route('api.profiles.show', compact('profile')),
        ]);
    }

    /**
     * Returns the profile as is in the database
     *
     * @param  \Brainr\Profile  $profile
     *
     * @return \Brainr\Profile
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Profile $profile)
    {
        $this->authorize('read', $profile);

        return $profile;
    }

    /**
     * Patches a profile
     * TODO: Allow tags to be stored
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Brainr\Profile  $profile
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $request->validate([
            'name' => ['sometimes', 'string', 'max:100'],
            'description' => ['sometimes', 'nullable', 'string'],
            'content' => ['sometimes', 'nullable', 'string'],
        ]);

        $profile->fill($request->all())
                ->saveOrFail();

        return response(null, 204);
    }

    /**
     * Deletes a profile
     *
     * @param  \Brainr\Profile  $profile
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|object
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('update', $profile);

        $profile->delete();

        return response(null, 204);
    }
}
