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

Route::get('/term', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@Index')->name('dashboard');

Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});

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
    

    });   
    Route::group(['prefix' => 'sms'], function(){
        Route::get('','SmsController@Index')->name('sms');  
        Route::get('send','SmsController@Send')->name('sms.send');           
        Route::get('credit','SmsController@Credit')->name('sms.credit');  
        Route::post('verify','SmsController@Verify')->name('sms.verify');
    });    
    Route::group(['prefix' => 'setting'], function(){
        Route::group(['prefix' => 'dashboard'], function(){
            //setting ของ dashboard
            Route::group(['prefix' => 'prefix'], function(){
                Route::get('','SettingDashboardPrefixController@Index')->name('setting.dashboard.prefix');           
                Route::get('create','SettingDashboardPrefixController@Create')->name('setting.dashboard.prefix.create'); 
                Route::post('createsave','SettingDashboardPrefixController@CreateSave')->name('setting.dashboard.prefix.createsave'); 
                Route::get('edit/{id}','SettingDashboardPrefixController@Edit')->name('setting.dashboard.prefix.edit'); 
                Route::post('editsave/{id}','SettingDashboardPrefixController@EditSave')->name('setting.dashboard.prefix.editsave'); 
                Route::get('delete/{id}','SettingDashboardPrefixController@Delete')->name('setting.dashboard.prefix.delete'); 
            }); 
            Route::group(['prefix' => 'religion'], function(){
                Route::get('','SettingDashboardReligionController@Index')->name('setting.dashboard.religion');           
                Route::get('create','SettingDashboardReligionController@Create')->name('setting.dashboard.religion.create'); 
                Route::post('createsave','SettingDashboardReligionController@CreateSave')->name('setting.dashboard.religion.createsave'); 
                Route::get('edit/{id}','SettingDashboardReligionController@Edit')->name('setting.dashboard.religion.edit'); 
                Route::post('editsave/{id}','SettingDashboardReligionController@EditSave')->name('setting.dashboard.religion.editsave'); 
                Route::get('delete/{id}','SettingDashboardReligionController@Delete')->name('setting.dashboard.religion.delete'); 
            });
            Route::group(['prefix' => 'country'], function(){
                Route::get('','SettingDashboardCountryController@Index')->name('setting.dashboard.country');           
                Route::get('create','SettingDashboardCountryController@Create')->name('setting.dashboard.country.create'); 
                Route::post('createsave','SettingDashboardCountryController@CreateSave')->name('setting.dashboard.country.createsave'); 
                Route::get('edit/{id}','SettingDashboardCountryController@Edit')->name('setting.dashboard.country.edit'); 
                Route::post('editsave/{id}','SettingDashboardCountryController@EditSave')->name('setting.dashboard.country.editsave'); 
                Route::get('delete/{id}','SettingDashboardCountryController@Delete')->name('setting.dashboard.country.delete'); 
            });
        }); 
        Route::group(['prefix' => 'website'], function(){
           //setting ของ website
        }); 
    });   
});  

Route::group(['prefix' => 'line'], function(){
    Route::get('','LineSubScribeController@Index')->name('line');        
    Route::get('linesubscribe/{id}', 'LineSubScribeController@LineSubcribe')->name('line.subcribe');
    Route::get('linecallback', 'LineSubScribeController@LineCallback')->name('line.callback');
    Route::get('linesend', 'LineSubScribeController@LineSend')->name('line.send');           
}); 


