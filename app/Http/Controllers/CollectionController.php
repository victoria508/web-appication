<?php

namespace Brainr\Http\Controllers;

use Brainr\Collection;
use Brainr\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    /**
     * CollectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows all the collections of a user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $collections = Auth::user()
                           ->collections()
                           ->with('rootprofile')
                           ->paginate();

        return view('collection.index', compact('collections'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Collection::class);

        return view('collection.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $this->authorize('create', Collection::class);

        $request->validate([
            'name' => ['required', 'unique:collections', 'max:100'],
        ]);

        try {
            DB::beginTransaction();

            $collection = new Collection($request->all());
            $collection->owner()
                       ->associate(Auth::user());
            $collection->saveOrFail();

            $entry = new Profile($request->all());
            $entry->collection()
                  ->associate($collection)
                  ->saveOrFail();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            $request->session()
                    ->flash('error', 'Unable to create collection');

            return redirect()->back();
        }

        $request->session()
                ->flash('success', 'Collection created successfully');

        return redirect()->route('profiles.show', [$entry]);
    }

    public function show(Collection $collection)
    {
        $this->authorize('read', $collection);

        $profile = $collection->rootprofile;

        return redirect()->route('profiles.show', compact('profile'));
    }

    /**
     * @param \Brainr\Collection $collection
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Collection $collection)
    {
        $this->authorize('update', $collection);

        return view('collection.edit', compact('collection'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Collection       $collection
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $request->validate([
            'name' => ['required', 'max:100'],
        ]);

        $collection->fill($request->all());

        if ($collection->save()) {
            $request->session()
                    ->flash('success', 'Collection saved successfully');

            return redirect()->route('collections.index');
        }

        $request->session()
                ->flash('error', 'Unable to create collection');

        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Brainr\Collection       $collection
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        $request->session()
                ->flash('success', 'Collection has been deleted');

        return redirect()
            ->route('collections.index');
    }
}
