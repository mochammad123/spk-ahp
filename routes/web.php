<?php

use App\Http\Controllers\AlternativeComparisonController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AlternativeSingleComparisonController;
use App\Http\Controllers\CriteriaComparisonController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubcriteriaComparisonController;
use App\Http\Controllers\SubcriteriaController;
use App\Models\Alternative;
use App\Models\AlternativeComparison;
use App\Models\AlternativeSingleComparison;
use App\Models\Criteria;
use App\Models\Decision;
use App\Models\Pvsubcriteria;
use App\Models\Subcriteria;
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

Route::get('/', function () {
    return view('home', [
        'title' => 'home'
    ]);
});

Route::get('/dashboard/decisions', function () {
    return view('dashboard.decisions.decisions');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'criterias' => Criteria::all(),
        'subcriterias' => Subcriteria::all(),
        "alternatives" => Alternative::all()
    ]);
})->middleware('auth');

Route::get('/dashboard/subcriteria', function () {
    return view('dashboard.subcriteria.index', [
        'criterias' => Criteria::all()
    ]);
});

Route::get('/dashboard/subcriteriacomparison', function () {
    return view('dashboard.subcriteriacomparison.index', [
        'criterias' => Criteria::all(),
        'pvsubcriterias' => Pvsubcriteria::all()
    ]);
});

Route::get('/dashboard/alternativecomparison', function () {
    return view('dashboard.alternativecomparison.index', [
        'criterias' => Criteria::all(),
        'subcriterias' => Subcriteria::all(),
        'alternativecomparisons' => AlternativeComparison::all(),
        'alternativesinglecomparisons' => AlternativeSingleComparison::all()
    ]);
});

Route::resource('/dashboard/criterias', CriteriaController::class)->middleware('auth');

Route::resource('/dashboard/subcriterias', SubcriteriaController::class)->middleware('auth');

Route::resource('/dashboard/alternatives', AlternativeController::class)->middleware('auth');

Route::resource('/dashboard/criteriacomparisons', CriteriaComparisonController::class)->middleware('auth');

Route::get('/dashboard/criteria/checkSlug', [CriteriaController::class, 'checkSlug'])->middleware('auth');

Route::get('/dashboard/show/{criteriaId}', [SubcriteriaController::class, 'show'])->middleware('auth');

Route::post('/dashboard/process', [CriteriaComparisonController::class, 'process'])->middleware('auth');

Route::post('/dashboard/priority', [CriteriaComparisonController::class, 'priority'])->middleware('auth');

Route::get('/dashboard/showsubcriteria/{subcriteriaId}', [SubcriteriaComparisonController::class, 'show'])->middleware('auth');

Route::post('/dashboard/processsubcriteria', [SubcriteriaComparisonController::class, 'process'])->middleware('auth');

Route::post('/dashboard/prioritysubcriteria', [SubcriteriaComparisonController::class, 'priority'])->middleware('auth');

Route::get('/dashboard/showasubcriteria/{subcriteriaId}', [AlternativeComparisonController::class, 'show'])->middleware('auth');

Route::post('/dashboard/processalternative', [AlternativeComparisonController::class, 'process'])->middleware('auth');

Route::get('/dashboard/result', [AlternativeComparisonController::class, 'result'])->middleware('auth');

Route::get('/dashboard/showacriteria/{criteriaId}', [AlternativeSingleComparisonController::class, 'show'])->middleware('auth');

Route::post('/dashboard/processalternativesingle', [AlternativeSingleComparisonController::class, 'process'])->middleware('auth');

Route::post('/dashboard/priorityalternative', [AlternativeSingleComparisonController::class, 'priority'])->middleware('auth');

Route::get('/dashboard/resultalternative', [AlternativeSingleComparisonController::class, 'result'])->middleware('auth');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
