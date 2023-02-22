<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\CarouselImage;
use Illuminate\Http\Request;

class CarouselImageController extends Controller
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

        $submodule = 'Carrusel de imágenes';

        $location  = 'Inicio';

        return view('system.carousel-images.index', [
            'module'    => $module,
            'submodule' => $submodule,
            'location'  => $location
        ]);

    }

    public function create( Request $request )
    {

        $module     = 'Publicación';

        $submodule  = 'Carrusel de imágenes';

        $location   = 'Crear';

        return view('system.carousel-images.create', [
            'module'     => $module,
            'submodule'  => $submodule,
            'location'   => $location
        ]);

    }

    public function saveCreate( Request $request )
    {

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'link_url'    => 'required',
            'image_url'   => 'required'
        ]);

        $validateImageTitle = CarouselImage::validateImageTitle( $request->title, null );

        if ( $validateImageTitle ) {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ya existe una imágen con el titulo: $request->title.");

        } else {

            $result = CarouselImage::createItem( $request );

            if ($result) {

                return redirect()->route('carousel-image-index')->with('success', "Exito!, imágen creado correctamente.");

            } else {

                return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

    public function update( Request $request )
    {

        $module     = 'Publicación';

        $submodule  = 'Sitios';

        $location   = 'Editar';

        $item       = CarouselImage::findOrFail( $request->id );

        return view('system.carousel-images.update', [
            'module'     => $module,
            'submodule'  => $submodule,
            'location'   => $location,
            'item'       => $item
        ]);

    }

    public function saveUpdate( Request $request )
    {

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'link_url'    => 'required',
            'image_url'   => 'required'
        ]);

        $validateImageTitle = CarouselImage::validateImageTitle( $request->title, $request->id );

        if ( $validateImageTitle ) {

            return redirect()->route('carousel-image-index')->with('error', "Ups!, ya existe una imágen con el titulo:: $request->title.");

        } else {

            $result = CarouselImage::updateItem( $request );

            if ($result) {

                return redirect()->route('carousel-image-index')->with('success', "Exito!, imágen editada correctamente.");

            } else {

                return redirect()->route('carousel-image-index')->with('error', "Ups!, ha ocurrido un error.");

            }

        }

    }

}
