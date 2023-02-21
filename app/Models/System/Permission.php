<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $casts = [
        'permissions'  => 'json'
    ];

    const TABLE      = "permissions";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public static function getPermissions( $user_id )
    {
        $permissions = null;

        $query = self::where('user_id', $user_id)
            ->where('status', self::ALIVE)
            ->first();

        if ( $query ) {

            $permissions = $query->permissions;

        }

        return $permissions;
    }

}
