<?php

namespace Brainr\Http\Controllers;

use Brainr\Profile;
use Brainr\ProfileRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileRelationController extends Controller
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

        $profiles = $profile->collection->profiles()
                                       ->where('id', '!=', $profile->id)
                                       ->whereNotIn('id', function ($query) use ($profile) {
                                           $query->select('eerl.profile_id')
                                                 ->from('profile_profile_relation AS eerl')
                                                 ->rightJoin('profile_profile_relation AS eerr',
                                                     'eerl.profile_relation_id', '=', 'eerr.profile_relation_id')
                                                 ->where('eerr.profile_id', $profile->id);
                                       })
                                       ->get();

        return view('relation.create', compact('profile', 'profiles'));
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
            'name'         => ['nullable', 'string', 'max:100'],
            'related'      => [
                'required',
                Rule::notIn([$profile->id]),
                Rule::exists('profiles', 'id')
                    ->where('collection_id', $profile->collection->id),
            ],
        ]);

        $related = Profile::find($request->get('related'));

        try {
            DB::beginTransaction();

            $relation = new ProfileRelation($request->all());
            $relation->collection()
                     ->associate($profile->collection)
                     ->saveOrFail();

            $relation->profiles()
                     ->attach([$profile->id, $related->id]);

            DB::commit();


        } catch (\Exception $e) {

            DB::rollBack();

            dd($e);

            $request->session()
                    ->flash('error', 'Unable to create collection');

            return redirect()->back();
        }

        $request->session()
                ->flash('success', 'Collection saved successfully');

        return redirect()->route('profiles.show', [$profile]);

    }

    /**
     * @param \Brainr\Profile         $profile
     * @param \Brainr\ProfileRelation $relation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Profile $profile, ProfileRelation $relation)
    {
        $this->authorize('update', $profile->collection);

        return view('relation.edit', compact('profile', 'relation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Profile           $profile
     * @param \Brainr\ProfileRelation   $relation
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Profile $profile, ProfileRelation $relation)
    {
        $this->authorize('update', $profile->collection);

        $request->validate([
            'name' => ['nullable', 'string', 'max:100'],
        ]);

        $relation->fill($request->all());

        if ($relation->save()) {
            $request->session()
                    ->flash('success', 'Relation created successfully');

            return redirect()->route('profiles.show', [$profile]);
        }

        $request->session()
                ->flash('error', 'Unable to create relation');

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Profile           $profile
     * @param \Brainr\ProfileRelation   $relation
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Profile $profile, ProfileRelation $relation)
    {
        $this->authorize('update', $profile->collection);

        if ($relation->delete()) {
            $request->session()
                    ->flash('success', 'Relation removed');
        } else {
            $request->session()
                    ->flash('error', 'Unable to remove relation');
        }

        return redirect()->back();
    }
}
