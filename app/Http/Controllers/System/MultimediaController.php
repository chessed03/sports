<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\ServiceImagesS3;
use Aws\S3\S3Client;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{

    public function uploadImage( Request $request )
    {

        $image = ServiceImagesS3::uploadImage( $request, "file" );

        return response()->json( ['location' => $image->url] );

    }

    public function uploadVideo( Request $request )
    {

        $video = ServiceImagesS3::uploadVideo( $request, "file" );

        return response()->json( ['location' => $video->url] );

    }

}
