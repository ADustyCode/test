<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JobseekerProfileController;
use App\Http\Controllers\EmployerProfileController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
   public function create(Request $request)
    {
        if ($request->routeIs('register-company')) {
            return view('auth.register-company');
        }

        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request);

        $type = $request->routeIs('register-company') ? 'employer' : 'jobseeker';
        dd($type);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            'password' => ['required','confirmed', Rules\Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'user_type' => ['required', 'in:jobseeker,employer'], // ✅ role
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->$type, // ✅ simpan role
        ]);

        if ($request->$type == "jobseeker"){
            $data = [
                'full_name' => $request->name,
                'headline' => '-',
                'location' => '-',
                'job_status' => '-',
                'summary' => '-',
                'main_field' => '-',
                'experience_years' => '-',
                'skills' => '-',
                'job_preference_type' => '-',
                'job_preference_location' => '-',
                'portfolio_url' => '-',
                'linkedin_url' => '-',
            ];

            JobseekerProfile::updateOrCreate(
                ['user_id' => $user->id],
                $data
            );
        } else {
            $data = [
                'company_name' => $request->name,
                'industry' => '-',
                'size' => '-',
                'year_founded' => '-',
                'location' => '-',
                'description' => '-',
                'website' => '-',
                'recruitment_email' => '-',
                'linkedin_link' => '-',
                'instagram_link' => '-',
                'culture' => '-',
            ];

            EmployerProfile::updateOrCreate(
                ['user_id' => $user->id],
                $data
            );
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

}
