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

        $validatedData = $request->validate([
            'full_name' => 'required|string|min:4|max:70',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|numeric|unique:applicant_profiles,phone_number,' . ($profile->id ?? 'NULL'),
            'address' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
            'resume' => $request->method() == 'PUT' ? 'required|file|mimes:pdf|mimetypes:application/pdf|max:2048|' : 'nullable|file|mimes:pdf|mimetypes:application/pdf|max:2048',
            'image' => $request->method() == 'PUT' ? 'required|image|mimes:jpeg,png,jpg,svg|mimetypes:image/jpeg,image/png,image/jpg,image/svg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg,svg|mimetypes:image/jpeg,image/png,image/jpg,image/svg|max:2048',
        ]);

        try {

            if ($request->hasFile('resume')) {
                if ($profile->resume) {
                    Storage::disk('public')->delete($profile->resume);
                }

                $validatedData['resume'] = $request->file('resume')->store('resumes', 'public');
            } else {
                $validatedData['resume'] = $profile->resume;
            }

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
            if ($profile->resume) {
                Storage::disk('public')->delete($profile->resume);
            }

            if ($profile->image) {
                Storage::disk('public')->delete($profile->image);
            }

            return redirect()->route('panel.profile.edit')->with('error', $error->getMessage());
        }
    }
}
