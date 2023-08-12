<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {

        $path = $request->file('avatar')->store('avatars');

        auth()->user()->update([
            'avatar' => storage_path('app') . "/$path"
        ]);

        return redirect(route('profile.edit'))->with('success', 'Uploaded Avatar Successfully!');
    }
}
