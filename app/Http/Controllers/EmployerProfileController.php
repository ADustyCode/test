<?php

namespace App\Http\Controllers;

use App\Models\EmployerProfile;
use Illuminate\Http\Request;

class EmployerProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        abort_if($user->user_type !== 'employer', 403);

        $profile = $user->employerProfile()->firstOrCreate(['user_id' => $user->id], [
            'company_name' => $user->name,
        ]);

        return view('profile.employer-show', compact('profile'));
    }

    public function edit()
    {
        return redirect()->route('employer.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        abort_if($user->user_type !== 'employer', 403);

        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:50',
            'year_founded' => 'nullable|integer|min:1800|max:' . date('Y'),
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'recruitment_email' => 'nullable|email|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'culture' => 'nullable|string|max:500',
        ]);

        EmployerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()
            ->route('employer.profile.show')
            ->with('success', 'Profil perusahaan berhasil diperbarui');
    }
}
