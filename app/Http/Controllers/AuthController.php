<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure the User model is imported
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    /**
     * Handle user login and generate a token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Update last login time
            $user->last_login = now();
            $user->save();

            $token = $user->createToken('auth-token')->plainTextToken; // Generate API token

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token, // Return the token
            ], 200);
        }

        return response()->json(['message' => 'Invalid email or password'], 401);
    }
//////////////////////////////

public function forgotPassword(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Vérifier si l'email existe dans la base de données
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return response()->json(['message' => 'Email non trouvé'], 404);
    }

    // Générer un token de réinitialisation
    $token = Password::createToken($user);

    // Envoyer un email avec le lien de réinitialisation
    Mail::to($user->email)->send(new ResetPasswordMail($token));

    return response()->json(['message' => 'Un lien de réinitialisation a été envoyé à votre email'], 200);
}










///////////////////////////
    /**
     * Handle role-based dashboard access.
     */
    public function dashboard(Request $request)
    {
        $user = $request->user(); // Get authenticated user

        switch ($user->role) {
            case 'medcin':
                return response()->json([
                    'message' => 'Welcome, Doctor!',
                    'data' => 'Doctor Dashboard Content',
                ]);
            case 'infirmier':
                return response()->json([
                    'message' => 'Welcome, Nurse!',
                    'data' => 'Nurse Dashboard Content',
                ]);
            case 'secretaire':
                return response()->json([
                    'message' => 'Welcome, Secretary!',
                    'data' => 'Secretary Dashboard Content',
                ]);
            case 'administratif':
                return response()->json([
                    'message' => 'Welcome, Admin Staff!',
                    'data' => 'Administrative Dashboard Content',
                ]);
            case 'technicien':
                return response()->json([
                    'message' => 'Welcome, Technician!',
                    'data' => 'Technician Dashboard Content',
                ]);
            default:
                return response()->json([
                    'message' => 'Unauthorized role',
                ], 403);
        }
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); // Revoke the current token only
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

     /**
     * Get the authenticated User.
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

