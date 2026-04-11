<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // Custom validation to allow consistent response format
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|unique:leads,email',
            'phone' => 'required|string|unique:leads,phone',
        ]);
    
        if ($validator->fails()) {
            // Get the first error message only
            $firstError = $validator->errors()->first();
            return response()->json([
                'status' => 'error',
                'message' => $firstError
            ], 200);
        }
    
        // Create lead if validation passes
        Lead::create($request->only('email', 'phone'));
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data saved successfully.'
        ], 200);
    }    
}
