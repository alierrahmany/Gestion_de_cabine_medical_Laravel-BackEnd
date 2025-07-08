<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role !== 'administratif') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $users = User::all();
        return response()->json($users);
    }

    public function conge(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'secretaire' && $user->role !== 'admin') {
            return response()->json(['message' => 'Non autorisé à accéder à la liste des utilisateurs'], 403);
        }

        $users = User::all(['id', 'name', 'email', 'role']);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'administratif') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:medcin,infirmier,secretaire,administratif,technicien',
            'specialite' => 'nullable|string|max:255',
        ]);

        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'image' => 'no_image.jpg',
                'status' => 1,
            ];

            // Ajouter la spécialité seulement pour les rôles concernés
            if (in_array($request->role, ['medcin', 'infirmier', 'technicien'])) {
                $userData['specialite'] = $request->specialite;
            }

            $user = User::create($userData);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|in:medcin,infirmier,secretaire,administratif,technicien',
            'specialite' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $updateData = $request->only(['name', 'email', 'password', 'role']);

        // Gérer la spécialité selon le rôle
        if (in_array($request->role, ['medcin', 'infirmier', 'technicien'])) {
            $updateData['specialite'] = $request->specialite;
        } else {
            $updateData['specialite'] = null;
        }

        $user->update($updateData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}