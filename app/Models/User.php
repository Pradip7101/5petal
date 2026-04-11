<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ThemeOption;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    /**
     * Send the password reset notification to the user.
     * This method will generate the reset link and send the custom email.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $resetUrl = config('app.frontend_url') . '/reset-password/' . $token . '/' . urlencode($this->email);

        // Fetch the header logo from ThemeOption model
        $themeOption = ThemeOption::first();
        $headerLogo = $themeOption ? asset('admin_assets/uploads/' . $themeOption->header_logo) : asset('admin_assets/images/AdminLTELogo.png');

        // Send custom email with reset URL
        Mail::send('emails.password', ['resetUrl' => $resetUrl, 'headerLogo' => $headerLogo, 'user' => $this], function ($message) {
            $message->to($this->email)
                    ->subject('Reset Your Password');
        });
    }
}
