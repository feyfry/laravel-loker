<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        return view('backend.profile.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        $validatedData = $request->validate([
            'full_name' => 'required|string|min:4|max:70',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric|unique:applicant_profiles,phone_number,' . ($profile->id ?? 'NULL'),
            'address' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
            'resume_url' => 'nullable|url',
        ]);

        $profile->fill($validatedData);
        $profile->user_id = $user->id;
        $profile->save();

        return redirect()->route('panel.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
