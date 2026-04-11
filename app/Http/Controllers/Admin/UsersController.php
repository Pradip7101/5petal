<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UsersController extends Controller
{
    // Display a listing of the users.
    public function index()
    {
        $users = User::where('role', 'customer')->get(); // Adjusted role to 'customer'
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user.
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a newly created user in storage.
    public function store(Request $request)
    {
        $validated = $this->validateData($request);
    
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $this->handleFileUpload($request->file('profile_image'));
        }
    
        $validated['password'] = Hash::make($request->password);
        $validated['role'] = 'customer'; // Default role for new users
    
        User::create($validated);
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified user in storage.
    public function update(Request $request, User $user)
    { 
        $validated = $this->validateData($request,$user->id);

        if ($request->hasFile('profile_image')) {
            // Handle file upload and delete the old file
            $validated['profile_image'] = $this->handleFileUpload($request->file('profile_image'));
        }
    
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        $this->deleteOldFile($user->profile_image);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Validate user data
    private function validateData(Request $request, $dataId = null)
    {
        $uniqueEmailRule = 'unique:users,email' . ($dataId ? ',' . $dataId : '');

        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', $uniqueEmailRule],
            'password' => $dataId ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'nullable|string|in:customer',
            'phone' => [
                'required',
                'string',
                'regex:/^\+?[0-9\s\-()]*$/',
                function ($attribute, $value, $fail) {
                    $contactNoDigits = preg_replace('/[^\d]/', '', $value);
                    if (strlen($contactNoDigits) < 10 || strlen($contactNoDigits) > 15) {
                        $fail('Contact no must be between 10 and 15 digits.');
                    }
                },
            ],
        ]);
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
