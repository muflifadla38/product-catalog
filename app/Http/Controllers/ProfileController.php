<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $user = auth()->user();

        return $request->wantsJson()
            ? $this->jsonResponse(200, 'Berhasil mendapatkan data user', $user->only(['id', 'name', 'email', 'position']))
            : view('dashboard.profile.index', compact('user'));
    }
}
