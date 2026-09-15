<?php

use App\Http\Controllers\UtilityToolsController;
use Illuminate\Support\Facades\Route;

// Utility tools (tanpa shell exec — murni PHP)
Route::prefix('tools')->name('tools.')->group(function () {
    Route::get('/hash-generator', [UtilityToolsController::class, 'hashGenerator'])->name('hash-generator');
    Route::post('/hash-generator', [UtilityToolsController::class, 'hashGenerate']);
    Route::get('/pass-generator', [UtilityToolsController::class, 'passGenerator'])->name('pass-generator');
    Route::post('/pass-generator', [UtilityToolsController::class, 'passGenerate']);
    Route::get('/chmod-calc', [UtilityToolsController::class, 'chmodCalc'])->name('chmod-calc');
    Route::post('/chmod-calc', [UtilityToolsController::class, 'chmodCalculate']);
    Route::get('/base64-conv', [UtilityToolsController::class, 'base64Conv'])->name('base64-conv');
    Route::post('/base64-conv', [UtilityToolsController::class, 'base64Convert']);
    Route::get('/cron-parser', [UtilityToolsController::class, 'cronParser'])->name('cron-parser');
    Route::post('/cron-parser', [UtilityToolsController::class, 'cronParse']);
    Route::get('/json-viewer', [UtilityToolsController::class, 'jsonViewer'])->name('json-viewer');
    Route::post('/json-viewer', [UtilityToolsController::class, 'jsonValidate']);
    Route::get('/markdown-viewer', [UtilityToolsController::class, 'markdownViewer'])->name('markdown-viewer');
    Route::post('/markdown-viewer', [UtilityToolsController::class, 'markdownRender']);
});
