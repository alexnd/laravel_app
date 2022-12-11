<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=> 'Pages'], function () {
    // game
    Route::get('/', [PagesController::class, 'index'])->name('home');
    Route::get('/game/{uri}', [PagesController::class, 'game'])->name('game');
    Route::get('/play/{uri}', [PagesController::class, 'play'])->name('play');
    Route::get('/gamelog/{uri}', [PagesController::class, 'gamelog'])->name('gamelog');
    Route::get('/deactivate/{uri}', [PagesController::class, 'deactivate'])->name('deactivate');
    Route::get('/newgame/{uri}', [PagesController::class, 'newgame'])->name('newgame');
    Route::post('/creategame', [PagesController::class, 'creategame'])->name('creategame');
    Route::get('/creategame', [PagesController::class, 'notFound']);
    // static page with terms of conditions
    Route::get('/terms', [PagesController::class, 'terms'])->name('terms');
});

Route::group([
    'prefix' => 'admin',
    'namespace'=> 'Admin',
    'middleware' => ['auth', 'auth.admin']
], function () {
    // admin dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    // game users
    Route::get('/gameplayers', [AdminController::class, 'gamePlayers'])->name('admin.gameplayers');
    Route::get('/gameplayers/edit/{id}', [AdminController::class, 'gamePlayerEdit'])->name('admin.gameplayers.edit');
    Route::post('/gameplayers/update', [AdminController::class, 'gamePlayerUpdate'])->name('admin.gameplayers.update');
    Route::get('/gameplayers/add', [AdminController::class, 'gamePlayerAdd'])->name('admin.gameplayers.add');
    Route::post('/gameplayers/create', [AdminController::class, 'gamePlayerCreate'])->name('admin.gameplayers.create');
    Route::post('/gameplayers/delete', [AdminController::class, 'gamePlayerDelete'])->name('admin.gameplayers.delete');
    Route::get('/gameplayers/bids/{id}', [AdminController::class, 'gamePlayerBids'])->name('admin.gameplayers.bids');
    // system users
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/reset', [AdminController::class, 'resetUser'])->name('admin.users.reset');
    Route::post('/users/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/users/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    // feature flags
    Route::get('/flags', [AdminController::class, 'flags'])->name('admin.flags');
    Route::post('/flags', [AdminController::class, 'flagsUpdate'])->name('admin.flags.update');
});

require __DIR__.'/auth.php';

// for development stuff
Route::get('/test', function () {
    return view('test');
});
