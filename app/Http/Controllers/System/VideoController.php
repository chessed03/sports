<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {

            $access_route = ___routeArmored();

            if( !in_array( $access_route->route_name, $access_route->routes_access ) ) {

                return redirect()->route('403');

            }

            return $next($request);

        });
    }

    public function index( Request $request )
    {

        $module    = 'Publicación';

        $submodule = 'Videos';

        $location  = 'Inicio';

        return view('system.videos.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Videos';

        $location     = 'Crear';

        return view('system.videos.create', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'title'       => 'required',
            'subtitle'    => 'required',
            'description' => 'required',
            'video_url'   => 'required',
            'image_url'   => 'required'
        ]);

        $validateVideoTitle = Video::validateVideoTitle( $request->title, null );

        if ( $validateVideoTitle ) {

            return redirect()->route('video-index')->with('error', "Ups!, ya existe un video con el titulo: $request->title.");

        } else {

            $result = Video::createItem( $request );

            if ($result) {

                return redirect()->route('video-index')->with('success', "Exito!, video creado correctamente.");

            } else {

                return redirect()->route('video-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module       = 'Publicación';

        $submodule    = 'Videos';

        $location     = 'Editar';

        $item         = Video::findOrFail( $request->id );

        return view('system.videos.update', [
            'module'       => $module,
            'submodule'    => $submodule,
            'location'     => $location,
            'item'         => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'title'       => 'required',
            'subtitle'    => 'required',
            'description' => 'required',
            'video_url'   => 'required',
            'image_url'   => 'required'
        ]);

        $validateVideoTitle = Video::validateVideoTitle( $request->title, $request->id );

        if ( $validateVideoTitle ) {

            return redirect()->route('video-index')->with('error', "Ups!, ya existe un video con el titulo: $request->title.");

        } else {

            $result = Video::updateItem( $request );

            if ($result) {

                return redirect()->route('video-index')->with('success', "Exito!, video editado correctamente.");

            } else {

                return redirect()->route('video-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
