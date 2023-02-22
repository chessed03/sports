<?php

use App\Http\Controllers\System\CarouselImageController;
use App\Http\Controllers\System\MultimediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\System\PostController;
use App\Http\Controllers\System\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    //'register' => false,
    'verify' => true,
    'reset' => false
]);

Route::group(['middleware' => 'auth'], function () {

    # Routes Welcome
    Route::get('/', function () { return view('welcome'); });

    # Routes Dashboard
    Route::get('/dashboard', function() { return view('dashboard'); })->name('dashboard');

    # Routes Home
    Route::controller(HomeController::class)
        ->group(function () {

            Route::get('home', 'index')->name('home');
            Route::get('403', 'unauthorized')->name('403');

        });

    #Routes group of upload multimedia
    Route::controller(MultimediaController::class)
        ->prefix('multimedia')
        ->as('multimedia-')
        ->group(function () {

            Route::post('upload-image', 'uploadImage')->name('upload-image');
            Route::post('upload-video', 'uploadVideo')->name('upload-video');

        });

    #Routes group of publications menu
    Route::group(['prefix' => 'publications'], function () {

        #Routes posts
        Route::controller(PostController::class)
            ->prefix('posts')
            ->as('post-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');
                Route::get('preview/{id}', 'preview')->name('preview');

            });

        #Routes videos
        Route::controller(VideoController::class)
            ->prefix('videos')
            ->as('video-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

        #Routes carousel images
        Route::controller(CarouselImageController::class)
            ->prefix('carousel-images')
            ->as('carousel-image-')
            ->group(function () {

                Route::get('index', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('save-create', 'saveCreate')->name('save-create');
                Route::get('update/{id}', 'update')->name('update');
                Route::post('save-update', 'saveUpdate')->name('save-update');

            });

    });

});

