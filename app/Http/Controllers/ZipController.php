<?php

namespace App\Http\Controllers;

use File;
use ZipArchive;
use Illuminate\Http\Request;

class ZipController extends Controller
{
    public function downloadZip()
    {
        $zip = new ZipArchive;
        $filename = 'myNewFile.zip';
        if ($zip->open(public_path($filename), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('myFiles'));

            foreach ($files as $key=>$value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }
        return response()->download(public_path($filename));
    }
}
