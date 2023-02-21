<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\ServiceImagesS3;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage( Request $request )
    {

        $img = ServiceImagesS3::upload( $request, "file" );

        return response()->json( ['location' => $img->url] );

    }
}
