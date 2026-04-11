<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Models\ThemeOption;

class AuthController extends Controller
{
    // Handle user registration
    public function register(Request $request)
    {
        $this->validateRegistration($request);

        // Create a new user with the role 'customer'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Assign 'customer' role by default
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        // Fetch the header logo from ThemeOption model
        $themeOption = ThemeOption::first();
        $headerLogo = $themeOption ? asset('admin_assets/uploads/' . $themeOption->header_logo) : asset('admin_assets/images/AdminLTELogo.png');

        // Send welcome email to the user
        Mail::send('emails.user_registration_notify', ['headerLogo' => $headerLogo,'user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Welcome to 5Petal India');
        });

        // Send registration email to the admin
        Mail::send('emails.admin_registration_notify', ['headerLogo' => $headerLogo,'user' => $user], function ($message) {
            $message->to($themeOption->admin_email) // Replace with the admin email
                    ->subject('New Customer Registration');
        });

        return response()->json([
            'status'=>'success',
            'message' => 'Registration successful',
            'token' => $token,
            'user' => $user
        ], 201);
    }

    // Handle login request
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = Auth::user();

            // Prevent admin from logging in via frontend
            if ($user->role === 'admin') {
                return response()->json(['status'=>'error','message' => 'Admin users cannot log in from the frontend.'], 403);
            }

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status'=>'success',
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        return response()->json(['status'=>'error','message' => 'Invalid credentials'], 401);
    }

    // Handle logout request
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['status'=>'success','message' => 'Successfully logged out']);
    }

    // Handle change password request
    public function changePassword(Request $request)
    {
        // Ensure that only customers can change their passwords
        if ($request->user()->role === 'admin') {
            return response()->json(['status'=>'error','message' => 'Admins cannot change their password through this endpoint.'], 403);
        }

        // Validate the request
        $this->validateChangePassword($request);

        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['status'=>'error','message' => 'Current password is incorrect.'], 403);
        }

        // Update the password for the authenticated user
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['status'=>'success','message' => 'Password updated successfully.']);
    }

    // Handle forgot password request
    public function sendResetLinkEmail(Request $request)
    { 
        $this->validateForgotPassword($request);

        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json(['status'=>'success','message' => __($status)], 200);
        }

        return response()->json(['status'=>'error','message' => __($status)], 400);
    }

    // Handle reset password request
    public function resetPassword(Request $request)
    {
        $this->validateResetPassword($request);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));

                // Fetch the header logo from ThemeOption model
                $themeOption = ThemeOption::first();
                $headerLogo = $themeOption ? asset('admin_assets/uploads/' . $themeOption->header_logo) : asset('admin_assets/images/AdminLTELogo.png');

                // Send confirmation email after successful password reset
                Mail::send('emails.password_reset_confirmation', ['headerLogo' => $headerLogo,'user' => $user], function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Your Password Has Been Reset');
                });
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['status'=>'success','message' => __($status)], 200);
        }

        return response()->json(['status'=>'error','message' => __($status)], 400);
    }

    // Handle User Edit Profile request
    public function userEditProfile(Request $request)
    {
        // Validate the request
        $this->validateEditProfile($request);
        
        // Retrieve the authenticated user
        $user = $request->user();
        
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update phone if provided
        if ($request->has('phone')) {
            $user->phone = $request->phone; // Update the phone field
        }
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $this->validateImage($request->file('profile_image'));
    
            // Delete the old file if it exists
            if ($user->profile_image) {
                $this->deleteOldFile($user->profile_image);
            }
            
            $path = $this->handleFileUpload($request->file('profile_image'));
            $user->profile_image = asset('admin_assets/uploads/' . $path); // Update profile_image field
        }
    
        // Save user changes
        $user->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
            'user' => $user
        ], 200);
    }

    // =====================
    // Custom Private Methods
    // =====================

    private function validateRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&#]/', // At least one special character
                'confirmed',
            ],
        ]);
    }

    private function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    private function attemptLogin(Request $request)
    {
        return Auth::attempt($request->only('email', 'password'));
    }

    private function validateChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    }

    private function validateForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    }

    private function validateResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    // Custom validation for editing profile
    private function validateEditProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id, // Exclude current user from unique check
            'phone' => 'nullable|string|max:15', // Assuming phone is optional and can be a string
        ]);
    }

    // Custom validation for image upload
    private function validateImage($image)
    {
        $validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        if (!in_array($image->getClientMimeType(), $validTypes)) {
            throw new \Illuminate\Validation\ValidationException('Invalid image type.');
        }

        if ($image->getSize() > $maxSize) {
            throw new \Illuminate\Validation\ValidationException('Image size must be less than 2 MB.');
        }
    }

    // Handle profile image upload
    private function handleFileUpload($file)
    {   
        $timestamp = time();
        $originalNameWithExtension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($originalNameWithExtension, PATHINFO_FILENAME);
        $imageName = $originalName . '_' . $timestamp . '.' . $extension;
        $file->move(public_path('admin_assets/uploads'), $imageName);
        return $imageName;
    }

    // Delete old file
    private function deleteOldFile($filename)
    {
        $filePath = public_path('admin_assets/uploads/' . $filename);
        if ($filename && file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
