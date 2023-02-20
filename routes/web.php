<?php

use App\Http\Livewire\Relatorios\LocadorVeiculo;
use App\Http\Livewire\Revisoes\Cadastro as CadastroRevisoes;
use App\Http\Livewire\Manutencao\Cadastro as CadastroManutencao;
use App\Http\Livewire\Usuarios\Consulta as ConsultaUsers;
use App\Http\Livewire\Carros\Cadastro as CadastroCarros;
use App\Http\Livewire\Motoristas\Cadastro as CadastroMotoristas;
use App\Http\Livewire\Contratos\Cadastro as CadastroContratos;
use App\Http\Livewire\Repasses\Cadastro as CadastroRepasses;
use App\Http\Livewire\Usuarios\Repasses as UsuariosRepasses;
use App\Http\Livewire\Usuarios\Carros as UsuariosCarros;
use App\Http\Livewire\Usuarios\Reviews as UsuariosReviews;
use App\Http\Livewire\Usuarios\Maintenances as UsuariosMaintenances;
use \App\Http\Livewire\Usuarios\Detailsreviews as Detailsreviews;
use App\Http\Middleware\Authenticate as Authenticate;
use App\Http\Middleware\IsAdmRole as IsAdmRole;
use Illuminate\Support\Facades\Route;

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
require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/login');
    //return view('welcome');
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware([Authenticate::class])->group(function () {

    Route::middleware([IsAdmRole::class])->group(function () {
        Route::get('/users', ConsultaUsers::class)->name('users');
        Route::get('/carros', CadastroCarros::class)->name('carros');
        Route::get('/motoristas', CadastroMotoristas::class)->name('motoristas');
        Route::get('/contratos', CadastroContratos::class)->name('contratos');
        Route::get('/relatorios/locadores', LocadorVeiculo::class)->name('locadores');
        Route::get('/repasses/{id}', CadastroRepasses::class)->name('repasses');
        Route::get('/revisoes/{car_id}', CadastroRevisoes::class)->name('revisoes');
        Route::get('/manutencao/{car_id}', CadastroManutencao::class)->name('manutencao');
    });

    Route::get('/user/repasses/{id}', UsuariosRepasses::class)->name('user.repasses');
    Route::get('/user/carros', UsuariosCarros::class)->name('user.carros');
    Route::get('/user/revisoes/{car_id}', UsuariosReviews::class)->name('user.revisoes');
    Route::get('/user/manutencao/{car_id}', UsuariosMaintenances::class)->name('user.manutencao');
    Route::get('/user/revisoes/detalhes/{review_id}', Detailsreviews::class)->name('user.revisoes.detalhes');
});

