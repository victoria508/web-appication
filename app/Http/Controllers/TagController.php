<?php

namespace Brainr\Http\Controllers;

use Illuminate\Http\Request;
use Brainr\Tag;
use Brainr\Collection;
use Brainr\Profile;
use Brainr\ProfileRelation;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * @param \Brainr\Tag $Tag
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Tag $tag)
    {
        $this->authorize('update', $tag->collection);

        return view('tag.create', compact('tag'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Tag           $tag
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag->collection);

        $request->validate([
            'name'         => ['required', 'max:100'],
        ]);


        $request->session()
            ->flash('success', 'tag saved successfully');

        return redirect()->route('tags.show', [$tag]);
    }

    /**
     * @param \Brainr\Tag $tag
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Tag $tag)
    {
        $this->authorize('read', $tag->collection);

        return view('tag.show', compact('tag'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Tag          $tag
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag->collection);

        $request->validate([
            'name'         => ['required', 'max:100'],
        ]);

        $tag->fill($request->all());

        if ($tag->save()) {
            $tag->session()
                ->flash('success', 'Tag saved successfully');

            return redirect()->route('tags.show', [$tag]);
        }

        $request->session()
            ->flash('error', 'Unable to update tag');

        return redirect()->back();
    }

    /**
     * @param \Brainr\Tag $tag
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('update', $tag->collection);

        abort(502);
    }
}
