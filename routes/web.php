<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/experience', [PortfolioController::class, 'experience'])->name('experience');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [PortfolioController::class, 'sendContact'])->name('contact.store');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

require __DIR__.'/tools_utility.php';

Route::get('/tools', [ToolsController::class, 'index'])->name('tools.index');
Route::get('/tools/{slug}', [ToolsController::class, 'show'])->name('tools.show')->where('slug', '[a-z-]+');
Route::post('/tools/{slug}', [ToolsController::class, 'run'])->name('tools.run')->where('slug', '[a-z-]+');
