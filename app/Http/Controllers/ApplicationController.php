<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Notification;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewApplicationMail;
use App\Mail\ApplicationAcceptedMail;

class ApplicationController extends Controller
{
    /**
     * Daftar pelamar untuk satu lowongan (Employer)
     */
    public function index(Job $job)
    {
        $applications = Application::where('job_id', $job->id)
            ->with('jobseeker') // relasi sesuai model
            ->latest()
            ->paginate(10);

        return view('employer.jobs.applications', compact('job', 'applications'));
    }

    /**
     * Detail pelamar
     */
    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    /**
     * Update status lamaran (Employer menerima/menolak)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->update([
            'status' => $request->status,
        ]);

        // Kirim notifikasi ke jobseeker
        Notification::create([
            'user_id' => $application->jobseeker_id,
            'title' => 'Lamaran Anda ' . ucfirst($request->status),
            'message' => "Lamaran Anda untuk posisi {$application->job->title} telah {$request->status} oleh {$application->job->employer->name}.",
            'type' => $request->status === 'accepted' ? 'success' : 'warning',
        ]);

        // Kirim email jika diterima
        if ($request->status === 'accepted') {
            Mail::to($application->jobseeker->email)->send(new ApplicationAcceptedMail($application));
        }

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }

    /**
     * Hapus lamaran (opsional)
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return back()->with('success', 'Lamaran berhasil dihapus.');
    }

    /**
     * Apply lowongan (Jobseeker)
     */
    public function apply(Request $request, Job $job)
    {
        // Pastikan jobseeker
        if (auth()->user()->user_type !== 'jobseeker') {
            abort(403);
        }

        // Cek sudah pernah melamar atau belum
        $alreadyApplied = Application::where('job_id', $job->id)
            ->where('jobseeker_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'Kamu sudah melamar pekerjaan ini.');
        }

        // Simpan lamaran
        $application = Application::create([
            'job_id' => $job->id,
            'jobseeker_id' => auth()->id(),
            'status' => 'pending',
        ]);

        // Kirim notifikasi ke employer
        Notification::create([
            'user_id' => $job->employer_id,
            'title' => 'Pelamar Baru',
            'message' => auth()->user()->name . " baru saja melamar untuk posisi {$job->title}.",
            'type' => 'info',
        ]);

        // Kirim email ke employer
        Mail::to($job->employer->email)->send(new NewApplicationMail($application));

        return back()->with('success', 'Lamaran berhasil dikirim.');
    }

    /**
     * Daftar lamaran saya (Jobseeker)
     */
    public function myApplications()
    {
        if (auth()->user()->user_type !== 'jobseeker') {
            abort(403);
        }

        $applications = Application::with('job.employer')
            ->where('jobseeker_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('applications.my', compact('applications'));
    }
}
