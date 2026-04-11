<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user());
        }

        return $this->sendFailedLoginResponse();
    }

    // Handle logout request
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // Show the change password form
    public function showChangePasswordForm()
    {
        return view('admin.auth.change_password');
    }

    // Handle change password request
    public function changePassword(Request $request)
    {
        // Validate the request
        $this->validateChangePassword($request);

        $user = Auth::user();

        // Check if the provided current password matches the one in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Password updated successfully.');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot_password');
    }

    // Handle forgot password request
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateForgotPassword($request);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'admin') {
            return back()->withErrors(['email' => 'We couldn\'t find an admin with that email address.']);
        }

        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Show the reset password form
    public function showResetPasswordForm($token)
    {
        return view('admin.auth.reset_password', ['token' => $token]);
    }

    // Handle reset password request
    public function resetPassword(Request $request)
    {
        $this->validateResetPassword($request);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role !== 'admin') {
            return back()->withErrors(['email' => 'Failed to reset password.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // =====================
    // Custom Private Methods
    // =====================

    // Validate the login request
    private function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    // Attempt to log the user in
    private function attemptLogin(Request $request)
    {
        return Auth::attempt($request->only('email', 'password'));
    }

    // Handle post-authentication
    private function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();
        return redirect()->route('admin.login')->withErrors(['email' => 'Access denied.']);
    }

    // Handle failed login response
    private function sendFailedLoginResponse()
    {
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Validate change password request
    private function validateChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);
    }

    // Validate forgot password request
    private function validateForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    }

    // Validate reset password request
    private function validateResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    }
}
