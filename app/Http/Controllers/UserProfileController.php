<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'ktm' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $ktmPath = $user->ktm_path;
        if ($request->hasFile('ktm')) {
            if ($user->ktm_path) {
                Storage::disk('public')->delete($user->ktm_path);
            }
            $ktmPath = $request->file('ktm')->store('ktm_images', 'public');
        }

        $user->update([
            'name' => $validated['name'],
            'no_hp' => $validated['no_hp'],
            'jurusan' => $validated['jurusan'],
            'prodi' => $validated['prodi'],
            'ktm_path' => $ktmPath,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
