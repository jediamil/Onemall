<?php
// app/Http/Controllers/PermitController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PermitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'permit_files' => 'required|array',
            'permit_files.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240'
        ]);

        $uploadedFiles = [];

        foreach ($request->file('permit_files') as $file) {
            // Store file
            $path = $file->store('permits', 'public');
            
            // Generate the CORRECT URL manually
            $url = $this->getCorrectFileUrl($path);
            
            Log::info('File stored at: ' . $path);
            Log::info('Correct URL: ' . $url);

            $uploadedFiles[] = [
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'url' => $url, // This now has the correct URL
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientOriginalExtension(),
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Files uploaded successfully',
            'files' => $uploadedFiles
        ]);
    }

    private function getCorrectFileUrl($path)
    {
        // Method 1: Use the correct base URL (most reliable)
        $baseUrl = rtrim(config('app.url'), '/');
        return $baseUrl . '/storage/' . $path;
        
        // Method 2: If you're using Laravel's built-in server (artisan serve)
        // return url('storage/' . $path);
        
        // Method 3: Direct asset helper
        // return asset('storage/' . $path);
    }
}