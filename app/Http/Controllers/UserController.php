<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Get detail data user admin (termasuk foto profil avatar_url).
     */
    public function show(int|string $id): JsonResponse
    {
        $user = User::select(['id', 'name', 'email', 'avatar', 'created_at'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_url' => $user->avatar_url,
                'created_at' => $user->created_at?->format('d M Y'),
            ],
        ]);
    }

    /**
     * Get daftar semua user admin dengan foto profil.
     */
    public function index(): JsonResponse
    {
        $users = User::select(['id', 'name', 'email', 'avatar', 'created_at'])->get();

        $data = $users->map(fn ($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'avatar_url' => $user->avatar_url,
            'created_at' => $user->created_at?->format('d M Y'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
