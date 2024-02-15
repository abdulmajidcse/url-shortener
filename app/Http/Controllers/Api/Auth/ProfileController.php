<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return response()->json(['message' => 'Profile updated']);
    }
}
