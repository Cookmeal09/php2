<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showUploadForm()
    {
        return view('upload_form');
    }
    public function upload(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $file = $request->file('musicFile');

            $des = $request->input('description');
            $author = $request->input('author');
            $title = $request->input('title');

            $fileName = $_FILES["musicFile"]["name"]; // Original name of the uploaded file

            // Array of allowed file extensions
            $allowedExtensions = array("mp3", "wav", "ogg");

            // Get the file extension
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Check if the file extension is allowed
            if (in_array($fileExtension, $allowedExtensions)) {
                if ($file->storeAs('musics', $file->getClientOriginalName())) {
                    $music = new Music;
                    $music->File_name = $fileName;
                    $music->Description = $des;
                    $music->Author = $author;
                    $music->Title = $title;
                    $music->Active = 1;
                    $music->save();
                    echo "File uploaded successfully.<br>";
                } else {
                    echo "Error uploading file.<br>";
                }
            } else {
                echo "Invalid file type. Only MP3, WAV, and OGG files are allowed.";
            }
        }
        return redirect('/home');
    }
    public function index()
    {
        // $uploadDir = "musics"; // Directory where the uploaded file will be stored
        $songs = Music::all();

        // $files = Storage::files($uploadDir);

        // $validFiles = [];
        // foreach ($files as $file) {
        //     $extension = pathinfo($file, PATHINFO_EXTENSION);
        //     if ($extension === 'mp3' || $extension === 'ogg' || $extension === 'wav') {
        //         $validFiles[] = $file;
        //     }
        // }
        // foreach ($validFiles as $musicFile) {
        //     $contents = Storage::get($musicFile);

        //     $base64Music = base64_encode($contents);
        //     $html = '<audio controls>';
        //     $html .= '<source src="data:audio/mp3;base64,' . $base64Music . '" type="audio/mp3">';
        //     $html .= '</audio><br>';
        //     echo $html;
        // }
        return view('admin.music_home')
            ->with('songs', $songs);
        // ->with('validFiles', $validFiles);
    }
}
