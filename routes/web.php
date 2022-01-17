<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/generatepdf', 'pdfController@index')->name('pdf');

    
 //exisitng Sop
    Route::delete('sops/destroy', 'SopController@massDestroy')->name('sops.massDestroy');
    Route::post('sops/media', 'SopController@storeMedia')->name('sops.storeMedia');
    Route::post('sops/ckmedia', 'SopController@storeCKEditorImages')->name('sops.storeCKEditorImages');
   Route::get('sops/download/{sop_file}', 'SopController@download')->name('sops.download');
    Route::resource('sops', 'SopController');
    Route::get('sops/index/{id}', 'SopController@index')->name('sops.index');
    Route::get('sops/create/{id}', 'SopController@create')->name('sops.create');


    // Generate Sop
    Route::delete('generatesop/destroy', 'GeneratesopController.php@massDestroy')->name('generatesop.massDestroy');
    Route::post('generate-sops/parse-csv-import', 'GenerateSopController@parseCsvImport')->name('generate-sops.parseCsvImport');
    Route::post('generate-sops/process-csv-import', 'GenerateSopController@processCsvImport')->name('generate-sops.processCsvImport');
    Route::resource('generatesop', 'GeneratesopController');
    Route::post('generatesop/download', 'GeneratesopController@download')->name('generatesop.download');
    Route::get('/generatesop/{id}/approve', 'GeneratesopController@approve')->name('generatesop.approve');
    Route::get('/generatesop/{id}/delete', 'GeneratesopController@delete')->name('generatesop.delete');
    Route::get('/generatesop/{id}/review', 'GeneratesopController@review')->name('generatesop.review');
    
    

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    //Folders
    Route::resource('folders', 'FoldersController');
    Route::get('folders/check/{id}', 'FoldersController@check')->name('folders.check');
    Route::post('folders/showfolder', 'FoldersController@showfolder')->name('folders.showfolder');

    //Archive Folders
    Route::resource('archivefolders', 'ArchiveFoldersController');
    Route::get('archivefolders/check/{id}', 'ArchiveFoldersController@check')->name('archivefolders.check');
    Route::post('archivefolders/showfolder', 'ArchiveFoldersController@showfolder')->name('archivefolders.showfolder');
    
    //New PDF
    Route::view('/newpdf', 'newpdf');
    
    //Feedback
    Route::resource('feedback', 'FeedbackController');


    
});




Route::get('/admin/sops/create/generate', function()
{
    return 'Hello World';
});


