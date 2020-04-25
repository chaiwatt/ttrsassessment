<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@Index')->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'dashboard'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::get('','DashboardAdminController@Index')->name('dashboard.admin');           
        }); 
        Route::group(['prefix' => 'expert'], function(){
            Route::get('','DashboardExpertController@Index')->name('dashboard.expert');           
        }); 
        Route::group(['prefix' => 'company'], function(){
            Route::get('','DashboardCompanyController@Index')->name('dashboard.company')->middleware('verified');           
        }); 
        Route::group(['prefix' => 'setting'], function(){
            Route::group(['prefix' => 'prefix'], function(){
                Route::get('','DashboardSettingPrefixController@Index')->name('dashboard.setting.prefix');           
                Route::get('create','DashboardSettingPrefixController@Create')->name('dashboard.setting.prefix.create'); 
                Route::post('createsave','DashboardSettingPrefixController@CreateSave')->name('dashboard.setting.prefix.createsave'); 
                Route::get('edit/{id}','DashboardSettingPrefixController@Edit')->name('dashboard.setting.prefix.edit'); 
                Route::post('editsave/{id}','DashboardSettingPrefixController@EditSave')->name('dashboard.setting.prefix.editsave'); 
                Route::get('delete/{id}','DashboardSettingPrefixController@Delete')->name('dashboard.setting.prefix.delete'); 
            }); 
        }); 
    });   
    Route::group(['prefix' => 'sms'], function(){
        Route::get('','SmsController@Index')->name('sms');  
        Route::get('send','SmsController@Send')->name('sms.send');           
        Route::get('credit','SmsController@Credit')->name('sms.credit');  
        Route::post('verify','SmsController@Verify')->name('sms.verify');
    });      
});  

Route::group(['prefix' => 'line'], function(){
    Route::get('','LineSubScribeController@Index')->name('line');        
    Route::get('linesubscribe/{id}', 'LineSubScribeController@LineSubcribe')->name('line.subcribe');
    Route::get('linecallback', 'LineSubScribeController@LineCallback')->name('line.callback');
    Route::get('linesend', 'LineSubScribeController@LineSend')->name('line.send');           
}); 


