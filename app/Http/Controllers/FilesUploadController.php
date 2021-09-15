<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class FilesUploadController extends Controller
{
    public function storeFile(Request $request)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file("thumbnail");

                $filename = $file->getClientOriginalName();

                $ext = $file->getClientOriginalExtension();

                $folder = uniqid() . "_" . now()->timestamp;

                $file->storeAs('public/tmp/' . $folder, $filename);

                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename,
                    'ext' => $ext
                ]);

                return response()->json(['message' => "success", "file" => $folder], 200);
            }

            return;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }


    public function remove($folder)
    {
        try {
            $file = TemporaryFile::where('folder', $folder)->first();

            Storage::deleteDirectory('public/tmp/' . $folder);

            $file->delete();

            return response()->json(['message' => "success"], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }
}
