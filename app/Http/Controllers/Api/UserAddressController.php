<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pin_code' => 'required|string',
        ]);

        $user = Auth::user();
        $addressData = $request->only(['address', 'city', 'state', 'country', 'pin_code']);

        $address = UserAddress::updateOrCreate(
            ['user_id' => $user->id],
            $addressData
        );

        return response()->json(['status' => 'success', 'message' => 'Address updated successfully!']);
    }

    public function getAddress()
    {
        $user = Auth::user();

        // Assuming a user can have one address
        $address = UserAddress::where('user_id', $user->id)->first();

        if ($address) {
            return response()->json(['status' => 'success', 'address' => $address]);
        } else {
            return response()->json(['status' => 'success', 'address' => null]);
        }
    }
}
