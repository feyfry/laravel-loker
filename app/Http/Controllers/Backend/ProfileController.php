<?php

namespace App\Http\Controllers\Backend;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'profile' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        // Basic validation rules
        $rules = [
            'full_name' => 'required|string|min:4|max:70',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric|unique:applicant_profiles,phone_number,' . ($profile->id ?? 'NULL'),
            'address' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
        ];

        // Add conditional validation rules for files
        if ($request->hasFile('resume')) {
            $rules['resume'] = 'file|mimes:pdf|mimetypes:application/pdf|max:2048';
        }

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,svg|mimetypes:image/jpeg,image/png,image/jpg,image/svg|max:2048';
        }

        $validatedData = $request->validate($rules);

        try {
            // Handle resume upload
            if ($request->hasFile('resume')) {
                if ($profile->resume) {
                    Storage::disk('public')->delete($profile->resume);
                }
                $validatedData['resume'] = $request->file('resume')->store('resumes', 'public');
            } else {
                $validatedData['resume'] = $profile->resume;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($profile->image) {
                    Storage::disk('public')->delete($profile->image);
                }
                $validatedData['image'] = $request->file('image')->store('images', 'public');
            } else {
                $validatedData['image'] = $profile->image;
            }

            $profile->fill($validatedData);
            $profile->user_id = $user->id;
            $profile->save();

            return redirect()->route('panel.profile.edit')->with('success', 'Profile updated successfully!');

        } catch (\Exception $error) {
            // Only delete newly uploaded files if there's an error
            if ($request->hasFile('resume')) {
                Storage::disk('public')->delete($validatedData['resume'] ?? '');
            }
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($validatedData['image'] ?? '');
            }

            return redirect()->route('panel.profile.edit')->with('error', $error->getMessage());
        }
    }
}
