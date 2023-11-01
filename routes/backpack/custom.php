<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tags', 'TagsCrudController');
    Route::crud('mbkm', 'MbkmCrudController');
    Route::crud('partner', 'PartnerCrudController');

    Route::crud('acctive-account-mitra', 'AcctiveAccountMitraCrudController');

 
    Route::crud('validasi-mbkm', 'ValidasiMbkmCrudController');

    Route::crud('departmen', 'DepartmenCrudController');
    Route::crud('register-mbkm', 'RegisterMbkmCrudController');
    Route::crud('lecturer', 'LecturerCrudController');
    Route::get('mbkm/{id}/reg-mbkm', 'MbkmCrudController@register');
    Route::post('mbkm/{id}/addreg', 'MbkmCrudController@addreg');
    Route::get('mbkm-report', 'MbkmReportCrudController@viewReport');
    // Route::get('mbkm-report', function () {
    //     return view('vendor/backpack/crud/report_mbkm');
    // });
    Route::crud('management-m-b-k-m', 'ManagementMBKMCrudController');
    Route::crud('nilaimbkm', 'NilaimbkmCrudController');
    Route::get('/nilaimbkm/{id}/inputnilai', 'NilaimbkmCrudController@inputNilai');
    Route::crud('progress-mahasiswa', 'ProgressMahasiswaCrudController');

    // download route
    Route::get('/download/{name}', 'DownloadController@download');
}); // this should be the absolute last line of this file