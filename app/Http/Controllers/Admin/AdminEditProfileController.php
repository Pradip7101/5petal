<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminEditProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $admin = Auth::user();
    
        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Define the upload path
            $uploadPath = public_path('admin_assets/uploads');
    
            // Generate new file name with original name and timestamp
            $originalName = pathinfo($request->profile_image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->profile_image->extension();
            $timestamp = time();
            $imageName = $originalName . '-' . $timestamp . '.' . $extension;
    
            // Delete the previous image if it exists
            if ($admin->profile_image && file_exists($uploadPath . '/' . $admin->profile_image)) {
                unlink($uploadPath . '/' . $admin->profile_image);
            }
    
            // Store the new image
            $request->profile_image->move($uploadPath, $imageName);
    
            // Update the profile_image field with the new image name
            $admin->profile_image = $imageName;
        }
    
        // Save the changes
        $admin->save();
    
        // Redirect back with a success message
        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }    
    
}
