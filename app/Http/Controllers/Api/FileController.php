<?php

namespace Brainr\Http\Controllers\Api;

use Brainr\Http\Controllers\Controller;
use Brainr\File;
use Brainr\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * FileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Displays all files owned by the profile
     *
     * @param Profile $profile
     * @return mixed
     */
    public function index(Profile $profile)
    {
        return $profile->files;
    }

    public function show(Profile $profile)
    {
        //
    }

    public function store(Profile $profile, Request $request)
    {
        $request->validate([
            'file' => ['required', 'max:20000','mimes:pdf,xlx,csv,png,jpg,gif,doc,docx'],
            'filename' => ['required']
        ]);

        $path = $request->file('file')->store('profiles');
        $size = Storage::size($path);
        $files = $profile->files->create(['path' => $path, 'filename' => $request->filename, 'filesize' => $size]);

        return response($files, 201, [
            'Content-Location' => route('api.profiles.files.show', $profile),
        ]);
    }

    public function delete(Profile $profile, File $file)
    {
        Storage::delete($file->path);
        $file->delete();
        return response(null, 204);
    }

}
