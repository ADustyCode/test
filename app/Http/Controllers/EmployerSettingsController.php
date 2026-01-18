<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class EmployerSettingsController extends Controller
{
    public function index()
    {
        $employer = Auth::user();
        return view('employer.settings.index', compact('employer'));
    }

    // Update profil perusahaan
    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name'      => 'required|string|max:255',
            'industry'          => 'nullable|string|max:255',
            'size'              => 'nullable|string|max:50',
            'year_founded'      => 'nullable|integer|min:1800|max:' . date('Y'),
            'location'          => 'nullable|string|max:255',
            'description'       => 'nullable|string|max:500',
            'website'           => 'nullable|url|max:255',
            'recruitment_email' => 'nullable|email|max:255',
            'linkedin_link'     => 'nullable|url|max:255',
            'instagram_link'    => 'nullable|url|max:255',
            'culture'           => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        \App\Models\EmployerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'company_name'      => $request->company_name,
                'industry'          => $request->industry,
                'size'              => $request->size,
                'year_founded'      => $request->year_founded,
                'location'          => $request->location,
                'description'       => $request->description,
                'website'           => $request->website,
                'recruitment_email' => $request->recruitment_email,
                'linkedin_link'     => $request->linkedin_link,
                'instagram_link'    => $request->instagram_link,
                'culture'           => $request->culture,
            ]
        );

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    // Update keamanan akun
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Update email
        if ($request->filled('email') && $request->email !== $user->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
        }

        // Update password
        if ($request->filled('current_password') && $request->filled('password') && $request->filled('password_confirmation')) {
            $request->validate([
                'current_password' => 'required',
                'password' => ['required', 'confirmed', Password::min(8)],
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password saat ini salah.');
            }

            $user->password = Hash::make($request->password);
            $user->save();
        }

        return back()->with('success', 'Keamanan akun berhasil diperbarui.');
    }
}
