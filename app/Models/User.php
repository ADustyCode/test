<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // job yang disimpan oleh jobseeker
    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'jobseeker_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function jobseekerProfile()
    {
        return $this->hasOne(JobseekerProfile::class);
    }

    public function employerProfile()
    {
        return $this->hasOne(EmployerProfile::class);
    }



    /**
     * NOTIFIKASI DATABASE (BUKAN EMAIL)
     * NAMA AMAN, TIDAK BENTROK
     */
    public function pushNotification($title, $message, $type = null)
    {
        return $this->notifications()->create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false,
        ]);
    }




}
