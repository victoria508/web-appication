<?php

namespace Brainr\Http\Controllers;

use Brainr\Profile;
use Brainr\ProfileRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * CollectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param \Brainr\Profile $profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Profile $profile)
    {
        $this->authorize('update', $profile->collection);

        return view('profile.create', compact('profile'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Profile           $profile
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile->collection);

        $request->validate([
            'relation'     => ['nullable', 'string', 'max:100'],
            'name'         => ['required', 'max:100'],
            'data'         => ['sometimes', 'array'],
            'data.*.key'   => ['filled', 'distinct'],
            'data.*.value' => ['nullable'],
        ]);

        try {
            DB::beginTransaction();

            $newprofile = new Profile($request->all());
            $newprofile->collection()
                      ->associate($profile->collection)
                      ->saveOrFail();

            $relation = new ProfileRelation(['name' => $request->get('relation')]);
            $relation->collection()
                     ->associate($profile->collection)
                     ->saveOrFail();

            $relation->profiles()
                     ->attach([$profile->id, $newprofile->id]);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e);

            $request->session()
                    ->flash('error', 'Unable to create collection');

            return redirect()->back();
        }

        $request->session()
                ->flash('success', 'Profile saved successfully');

        return redirect()->route('profiles.show', [$newprofile]);
    }

    /**
     * @param \Brainr\Profile $profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Profile $profile)
    {
        $this->authorize('read', $profile->collection);

        return view('profile.show', compact('profile'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Profile           $profile
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile->collection);

        $request->validate([
            'name'         => ['required', 'max:100'], // TODO: add unique rule
            'data'         => ['sometimes', 'array'],
            'data.*.key'   => ['filled', 'distinct'],
            'data.*.value' => ['nullable'],
        ]);

        $profile->fill($request->all());

        if ($profile->save()) {
            $request->session()
                    ->flash('success', 'Profile saved successfully');

            return redirect()->route('profiles.show', compact('profile'));
        }

        $request->session()
                ->flash('error', 'Unable to update profile');

        return redirect()->back();
    }

    /**
     * @param \Brainr\Profile $profile
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('update', $profile->collection);

        abort(502);
    }
}
