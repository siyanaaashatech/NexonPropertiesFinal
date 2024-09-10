<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::with('socialLinks', 'metadata')->get();

        // Decode the image attribute back to an array for each site setting
        foreach ($siteSettings as $siteSetting) {
            $siteSetting->image = json_decode($siteSetting->image, true) ?: [];
        }

        return view('admin.sitesetting.index', compact('siteSettings'));
    }

    public function show()
    {}
    public function create()
    {
        $metadata = Metadata::all();
        $socialLinks = SocialLink::all();
        return view('admin.sitesetting.create', compact('metadata', 'socialLinks'));
    }

    public function edit($id)
    {
        $siteSetting = SiteSetting::with('metadata')->findOrFail($id);
        $siteSetting->image = json_decode($siteSetting->image, true) ?: []; // Decode image to array

        $socialLinks = SocialLink::first();
        return view('admin.sitesetting.update', compact('siteSetting', 'socialLinks'));
    }

    public function update(Request $request, SiteSetting $siteSetting)
    {
        // Validate SiteSetting fields
        $validatedData = $request->validate([
            'office_title' => 'required|string|max:255',
            'office_address' => 'required|string|max:255',
            'office_contact' => 'required|string',
            'office_email' => 'nullable|string|email',
            'office_description' => 'nullable|string',
            'established_year' => 'nullable|string',
            'slogan' => 'nullable|string',
            'image' => 'sometimes|array',
            'image.*' => 'sometimes|required|string',
            'status' => 'required|boolean',
            'cropData' => 'sometimes|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);
        
        // Validate Social Links
        $socialLinksData = $request->validate([
            'google_map' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'reddit_link' => 'nullable|url',
            'embed_fbpage' => 'nullable|string',
        ]);
    
        // Decode the existing images
        $images = !empty($siteSetting->image) ? json_decode($siteSetting->image, true) : [];
    
        // Handle new images if provided
        if ($request->has('image')) {
            foreach ($request->input('image') as $base64Image) {
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                    $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $decodedImage = base64_decode($base64Image);
    
                    if ($decodedImage === false) {
                        continue; // Skip invalid base64 string
                    }
    
                    $imageType = strtolower($type[1]); 
                    if (!in_array($imageType, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                        continue; // Skip unsupported image types
                    }
    
                    $imageResource = imagecreatefromstring($decodedImage);
                    if ($imageResource !== false) {
                        $imageName = time() . '-' . Str::uuid() . '.webp'; 
                        $destinationPath = storage_path('app/public/sitesettings');
    
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0755, true, true);
                        }
    
                        $savedPath = $destinationPath . '/' . $imageName;
                        imagewebp($imageResource, $savedPath);
                        imagedestroy($imageResource);
    
                        $relativeImagePath = 'storage/sitesettings/' . $imageName;
                        $images[] = $relativeImagePath;
                    }
                }
            }
        }
    
        // Update Site Setting record
        $siteSetting->update([
            'office_title' => $validatedData['office_title'],
            'office_address' => $validatedData['office_address'],
            'office_contact' => $validatedData['office_contact'],
            'office_email' => $validatedData['office_email'],
            'office_description' => $validatedData['office_description'],
            'established_year' => $validatedData['established_year'],
            'slogan' => $validatedData['slogan'],
            'image' => json_encode($images),
            'status' => $validatedData['status'],
        ]);
    
        // Update Metadata
        $siteSetting->metadata()->updateOrCreate(
            [],
            [
                'meta_title' => $validatedData['meta_title'] ?? $validatedData['office_title'],
                'meta_description' => $validatedData['meta_description'] ?? $validatedData['office_description'],
                'meta_keywords' => $validatedData['meta_keywords'],
                'slug' => Str::slug($validatedData['meta_title'] ?? $validatedData['office_title'])
            ]
        );
    
        // Update or create social links
        SocialLink::updateOrCreate(
            ['id' => 1], 
            $socialLinksData
        );
    
        session()->flash('success', 'Site setting updated successfully.');
        return redirect()->route('sitesettings.index');
    }
    


    public function destroy(SiteSetting $siteSetting)
    {
        $images = json_decode($siteSetting->image, true);
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/' . $image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $siteSetting->delete();

        return redirect()->route('sitesettings.index')->with('success', 'Site setting deleted successfully.');
    }

    protected function processImages(array $images)
    {
        $processedImages = [];
        foreach ($images as $base64Image) {
            // Handle image processing and saving here
            // Example: Decode base64, validate, save to file, and add path to $processedImages
        }
        return $processedImages;
    }
}
