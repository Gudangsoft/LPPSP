<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrNew([]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga'            => 'required|string|max:200',
            'singkatan'               => 'nullable|string|max:50',
            'tagline'                 => 'nullable|string|max:300',
            'deskripsi_singkat'       => 'nullable|string',
            'tentang_kami'            => 'nullable|string',
            'sejarah'                 => 'nullable|string',
            'visi'                    => 'nullable|string',
            'misi'                    => 'nullable|string',
            'legalitas'               => 'nullable|string',
            'sambutan_ketua_nama'     => 'nullable|string|max:200',
            'sambutan_ketua_jabatan'  => 'nullable|string|max:200',
            'sambutan_ketua_isi'      => 'nullable|string',
            'alamat'                  => 'nullable|string|max:500',
            'telepon'                 => 'nullable|string|max:50',
            'email'                   => 'nullable|email|max:100',
            'website'                 => 'nullable|url|max:200',
            'facebook'                => 'nullable|string|max:200',
            'instagram'               => 'nullable|string|max:200',
            'twitter'                 => 'nullable|string|max:200',
            'youtube'                 => 'nullable|string|max:200',
            'maps_embed'              => 'nullable|string',
            'logo'                    => 'nullable|image|max:2048',
            'favicon'                 => 'nullable|image|max:512',
            'foto_ketua'              => 'nullable|image|max:2048',
            'foto_struktur_organisasi'=> 'nullable|image|max:4096',
            'foto_tentang_kami'       => 'nullable|image|max:4096',
            'foto_layanan'            => 'nullable|image|max:2048',
            'deskripsi_layanan'       => 'nullable|string',
            'deskripsi_pengalaman'    => 'nullable|string',
            'hero_badge'              => 'nullable|string|max:100',
            'hero_image'              => 'nullable|image|max:4096', // Deprecated
            'hero_images.*'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_hero_images'      => 'nullable|array',
        ]);

        $profile = Profile::firstOrNew([]);

        if ($request->hasFile('logo')) {
            if ($profile->logo) Storage::disk('public')->delete($profile->logo);
            $validated['logo'] = $request->file('logo')->store('profile', 'public');
        }
        if ($request->hasFile('favicon')) {
            if ($profile->favicon) Storage::disk('public')->delete($profile->favicon);
            $validated['favicon'] = $request->file('favicon')->store('profile/favicon', 'public');
        }
        if ($request->hasFile('foto_ketua')) {
            if ($profile->foto_ketua) Storage::disk('public')->delete($profile->foto_ketua);
            $validated['foto_ketua'] = $request->file('foto_ketua')->store('profile', 'public');
        }
        if ($request->hasFile('foto_struktur_organisasi')) {
            if ($profile->foto_struktur_organisasi) Storage::disk('public')->delete($profile->foto_struktur_organisasi);
            $validated['foto_struktur_organisasi'] = $request->file('foto_struktur_organisasi')->store('profile', 'public');
        }
        if ($request->hasFile('foto_tentang_kami')) {
            if ($profile->foto_tentang_kami) Storage::disk('public')->delete($profile->foto_tentang_kami);
            $validated['foto_tentang_kami'] = $request->file('foto_tentang_kami')->store('profile', 'public');
        }
        if ($request->hasFile('foto_layanan')) {
            if ($profile->foto_layanan) Storage::disk('public')->delete($profile->foto_layanan);
            $validated['foto_layanan'] = $request->file('foto_layanan')->store('profile', 'public');
        }
        if ($request->hasFile('hero_image')) {
            if ($profile->hero_image) Storage::disk('public')->delete($profile->hero_image);
            $validated['hero_image'] = $request->file('hero_image')->store('profile', 'public');
        }

        // Handle Slider Hero Images
        $currentImages = $profile->hero_images ?? [];

        // Respect the new order if sent from SortableJS
        if ($request->has('hero_images_order') && !empty($request->hero_images_order)) {
            $newOrder = json_decode($request->hero_images_order, true);
            if (is_array($newOrder)) {
                $currentImages = $newOrder;
            }
        }

        if ($request->has('remove_hero_images')) {
            foreach ($request->remove_hero_images as $path) {
                Storage::disk('public')->delete($path);
                if (($key = array_search($path, $currentImages)) !== false) {
                    unset($currentImages[$key]);
                }
            }
            $currentImages = array_values($currentImages); // Reset keys after unset
        }
        
        if ($request->hasFile('hero_images')) {
            foreach ($request->file('hero_images') as $file) {
                $currentImages[] = $file->store('profile/sliders', 'public');
            }
        }
        $validated['hero_images'] = array_values($currentImages);

        $profile->fill($validated)->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }


}
