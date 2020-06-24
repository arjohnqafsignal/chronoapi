<?php

//Public routes

Route::get('me', 'User\MeController@getMe');

Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', 'Auth\LoginController@logout');
    Route::put('settings/profile', 'User\SettingsController@updateProfile');
    Route::put('settings/password', 'User\SettingsController@updatePassword');
    Route::post('settings/gettingstarted', 'User\SettingsController@saveGettingStarted');

    Route::group(['namespace' => 'Company', 'prefix' => 'company', 'as' => 'company.'], function () {

        Route::get('department', 'DepartmentController@index')->name('department.index');            
        Route::get('department/{department}', 'DepartmentController@show')->name('department.show');            
        Route::post('department', 'DepartmentController@store')->name('department.store');            
        Route::put('department/{department}', 'DepartmentController@update')->name('department.update');            
        Route::delete('department/{department}', 'DepartmentController@destroy')->name('department.destroy'); 
        
        Route::get('position', 'PositionController@index')->name('position.index');            
        Route::get('position/{position}', 'PositionController@show')->name('position.show');  
        Route::post('position', 'PositionController@store')->name('position.store');            
        Route::put('position/{position}', 'PositionController@update')->name('position.update');            
        Route::delete('position/{position}', 'PositionController@destroy')->name('position.destroy');

        Route::get('branch', 'BranchController@index')->name('branch.index');            
        Route::get('branch/{branch}', 'BranchController@show')->name('branch.show');  
        Route::post('branch', 'BranchController@store')->name('branch.store');            
        Route::put('branch/{branch}', 'BranchController@update')->name('branch.update');            
        Route::delete('branch/{branch}', 'BranchController@destroy')->name('branch.destroy');
        
        Route::get('level', 'LevelController@index')->name('level.index');            
        Route::get('level/{level}', 'LevelController@show')->name('level.show');  
        Route::post('level', 'LevelController@store')->name('level.store');            
        Route::put('level/{level}', 'LevelController@update')->name('level.update');            
        Route::delete('level/{level}', 'LevelController@destroy')->name('level.destroy');

        Route::get('bank', 'BankController@index')->name('bank.index');            
        Route::get('bank/{bank}', 'BankController@show')->name('bank.show');  
        Route::post('bank', 'BankController@store')->name('bank.store');            
        Route::put('bank/{bank}', 'BankController@update')->name('bank.update');            
        Route::delete('bank/{bank}', 'BankController@destroy')->name('bank.destroy');

        Route::post('employee', 'EmployeeController@store')->name('employee.store'); 
        
    });
    
});

//Guest only

Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('verification/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('confirm', 'Auth\VerificationController@index')->name('confirm');
    Route::post('verification/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::post('login', 'Auth\LoginController@login');
    
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('employee/login', 'Employee\Auth\LoginController@login');
});


Route::group(['middleware' => ['guest:employee']], function(){
 
    Route::post('employee/login', 'Employee\Auth\LoginController@login');
});

Route::get('products', 'TestController@index')->name('test.index');
Route::post('products', 'TestController@store')->name('test.store');