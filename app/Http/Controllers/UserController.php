<?php

namespace Brainr\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me()
    {
        $this->middleware('auth:sanctum');

        return Auth::user();
    }
}
