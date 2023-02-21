<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'schools' => 'json'
    ];

    const TABLE = "posts";

    const DELETED = 0;

    const ALIVE = 1;

    public static function getAlivePostsForView($keyWord, $paginateNumber, $orderBy)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        $query->whereRaw('status = "' . self::ALIVE . '"');

        $query->whereRaw('title LIKE "' . $keyWord . '"');

        if ($orderBy == 1) {

            $query->orderByRaw('title ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('title DESC');

        }

        if ($orderBy == 3) {

            $query->orderByRaw('created_at DESC');

        }

        if ($orderBy == 4) {

            $query->orderByRaw('created_at ASC');

        }

        $collection = $query->paginate($paginateNumber);

        if ($collection) {

            $result = $collection;

        }

        return $result;
    }

    public static function validatePostTitle($titulo, $id)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        if ($id) {

            $query->where('id', '!=', $id);

        }

        $query->where('title', $titulo);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ($rows) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem($data)
    {

        $item                    = new self();
        $item->title             = $data->title;
        $item->slug              = $data->slug;
        $item->subtitle          = $data->subtitle;
        $item->content           = $data->content;
        $item->image_feature_url = $data->image_feature_url;
        $item->created_by        = auth()->user()->id . "-" . auth()->user()->name;


        if ( $item->save() ) {

            return true;

        }

        return false;
    }

    public static function updateItem($data)
    {

        $item                    = self::where('id', $data->id)->first();
        $item->title             = $data->title;
        $item->slug              = $data->slug;
        $item->subtitle          = $data->subtitle;
        $item->content           = $data->content;
        $item->image_feature_url = $data->image_feature_url;

        if ( $item->update() ) {

            return true;

        }

        return false;
    }

    public static function getPostById( $id )
    {

        $result = null;

        if ( $id ) {

            $query = self::find( $id );

            if ( $query ) {

                $result = $query;

            }

        }

        return $result;

    }

}
