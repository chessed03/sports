<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    const TABLE      = "videos";

    const REMOVED    = 0;

    const ALIVE      = 1;

    public static function getAliveVideosForView($keyWord, $paginateNumber, $orderBy)
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

    public static function validateVideoTitle($titulo, $id)
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

        $item              = new self();
        $item->title       = $data->title;
        $item->subtitle    = $data->subtitle;
        $item->description = $data->description;
        $item->video_url   = $data->video_url;
        $item->image_url   = $data->image_url;
        $item->created_by  = auth()->user()->id . "-" . auth()->user()->name;


        if ( $item->save() ) {

            return true;

        }

        return false;
    }

    public static function updateItem($data)
    {

        $item              = self::where('id', $data->id)->first();
        $item->title       = $data->title;
        $item->subtitle    = $data->subtitle;
        $item->description = $data->description;
        $item->video_url   = $data->video_url;
        $item->image_url   = $data->image_url;

        if ( $item->update() ) {

            return true;

        }

        return false;
    }

}
