<?php

use App\Models\System\Permission;
use Illuminate\Support\Facades\Auth;

function ___routeArmored()
{

    session()->forget('route_name');

    $route_name = Route::currentRouteName();

    session()->put('route_name', $route_name);

    if ( !session()->get('access_routes') ) {

        return redirect()->route('welcome');

    }

    $result = (object)[
        'route_name'    => session()->get('route_name'),
        'routes_access' => session()->get('access_routes')[0]
    ];

    return $result;

}

function ___getPermissionUser()
{

    $result     = null;

    $route      = explode('-', session()->get('route_name'));

    $route_name = session()->get('route_name');

    if ( $route[1] != 'index' ) {

        $route_name = $route[0] . '-' . 'index';

    }

    $id         = Auth::id();

    $permission = Permission::getPermissions( $id );

    $module     = session()->get('access_permissions')[ array_search( $route_name, array_column(session()->get('access_permissions'), 'module_route') ) ];

    $access     = $permission[ array_search( $module->module_id, array_column($permission, 'module_id') ) ];

    if ( $access ) {

        $result = (object)[
            'read'    => $access['read'],
            'write'   => $access['write']
        ];

    }

    return $result;
}
