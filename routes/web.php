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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/term', function () {
//     return view('welcome');
// });

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('', 'HomeController@Index')->name('landing.index');


Route::group(['prefix' => 'social'], function(){       
    Route::get('/{provider}', 'Auth\LoginController@Redirect')->name('social.login');
    Route::get('callback/{provider}', 'Auth\LoginController@Callback')->name('social.callback');
});


Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'location'], function(){
        Route::post('province','Api\LocationController@Province')->name('api.location.province');           
        Route::post('amphur','Api\LocationController@Amphur')->name('api.location.amphur'); 
        Route::post('tambol','Api\LocationController@Tambol')->name('api.location.tambol'); 
    });  
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
            Route::get('','DashboardCompanyController@Index')->name('dashboard.company');           
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
            Route::group(['prefix' => 'educationbranch'], function(){
                Route::get('','SettingDashboardEducationBranchController@Index')->name('setting.dashboard.educationbranch');           
                Route::get('create','SettingDashboardEducationBranchController@Create')->name('setting.dashboard.educationbranch.create'); 
                Route::post('createsave','SettingDashboardEducationBranchController@CreateSave')->name('setting.dashboard.educationbranch.createsave'); 
                Route::get('edit/{id}','SettingDashboardEducationBranchController@Edit')->name('setting.dashboard.educationbranch.edit'); 
                Route::post('editsave/{id}','SettingDashboardEducationBranchController@EditSave')->name('setting.dashboard.educationbranch.editsave'); 
                Route::get('delete/{id}','SettingDashboardEducationBranchController@Delete')->name('setting.dashboard.educationbranch.delete'); 
            });
            Route::group(['prefix' => 'educationlevel'], function(){
                Route::get('','SettingDashboardEducationLevelController@Index')->name('setting.dashboard.educationlevel');           
                Route::get('create','SettingDashboardEducationLevelController@Create')->name('setting.dashboard.educationlevel.create'); 
                Route::post('createsave','SettingDashboardEducationLevelController@CreateSave')->name('setting.dashboard.educationlevel.createsave'); 
                Route::get('edit/{id}','SettingDashboardEducationLevelController@Edit')->name('setting.dashboard.educationlevel.edit'); 
                Route::post('editsave/{id}','SettingDashboardEducationLevelController@EditSave')->name('setting.dashboard.educationlevel.editsave'); 
                Route::get('delete/{id}','SettingDashboardEducationLevelController@Delete')->name('setting.dashboard.educationlevel.delete'); 
            });
            Route::group(['prefix' => 'businesstype'], function(){
                Route::get('','SettingDashboardBusinessTypeController@Index')->name('setting.dashboard.businesstype');           
                Route::get('create','SettingDashboardBusinessTypeController@Create')->name('setting.dashboard.businesstype.create'); 
                Route::post('createsave','SettingDashboardBusinessTypeController@CreateSave')->name('setting.dashboard.businesstype.createsave'); 
                Route::get('edit/{id}','SettingDashboardBusinessTypeController@Edit')->name('setting.dashboard.businesstype.edit'); 
                Route::post('editsave/{id}','SettingDashboardBusinessTypeController@EditSave')->name('setting.dashboard.businesstype.editsave'); 
                Route::get('delete/{id}','SettingDashboardBusinessTypeController@Delete')->name('setting.dashboard.businesstype.delete'); 
            });
            Route::group(['prefix' => 'industrygroup'], function(){
                Route::get('','SettingDashboardIndustryGroupController@Index')->name('setting.dashboard.industrygroup');           
                Route::get('create','SettingDashboardIndustryGroupController@Create')->name('setting.dashboard.industrygroup.create'); 
                Route::post('createsave','SettingDashboardIndustryGroupController@CreateSave')->name('setting.dashboard.industrygroup.createsave'); 
                Route::get('edit/{id}','SettingDashboardIndustryGroupController@Edit')->name('setting.dashboard.industrygroup.edit'); 
                Route::post('editsave/{id}','SettingDashboardIndustryGroupController@EditSave')->name('setting.dashboard.industrygroup.editsave'); 
                Route::get('delete/{id}','SettingDashboardIndustryGroupController@Delete')->name('setting.dashboard.industrygroup.delete'); 
            });
            Route::group(['prefix' => 'registeredcapitaltype'], function(){
                Route::get('','SettingDashboardRegisteredCapitalTypeController@Index')->name('setting.dashboard.registeredcapitaltype');           
                Route::get('create','SettingDashboardRegisteredCapitalTypeController@Create')->name('setting.dashboard.registeredcapitaltype.create'); 
                Route::post('createsave','SettingDashboardRegisteredCapitalTypeController@CreateSave')->name('setting.dashboard.registeredcapitaltype.createsave'); 
                Route::get('edit/{id}','SettingDashboardRegisteredCapitalTypeController@Edit')->name('setting.dashboard.registeredcapitaltype.edit'); 
                Route::post('editsave/{id}','SettingDashboardRegisteredCapitalTypeController@EditSave')->name('setting.dashboard.registeredcapitaltype.editsave'); 
                Route::get('delete/{id}','SettingDashboardRegisteredCapitalTypeController@Delete')->name('setting.dashboard.registeredcapitaltype.delete'); 
            });
            Route::group(['prefix' => 'businessplanstatus'], function(){
                Route::get('','SettingDashboardBusinessPlanStatusController@Index')->name('setting.dashboard.businessplanstatus');           
                Route::get('create','SettingDashboardBusinessPlanStatusController@Create')->name('setting.dashboard.businessplanstatus.create'); 
                Route::post('createsave','SettingDashboardBusinessPlanStatusController@CreateSave')->name('setting.dashboard.businessplanstatus.createsave'); 
                Route::get('edit/{id}','SettingDashboardBusinessPlanStatusController@Edit')->name('setting.dashboard.businessplanstatus.edit'); 
                Route::post('editsave/{id}','SettingDashboardBusinessPlanStatusController@EditSave')->name('setting.dashboard.businessplanstatus.editsave'); 
                Route::get('delete/{id}','SettingDashboardBusinessPlanStatusController@Delete')->name('setting.dashboard.businessplanstatus.delete'); 
            });
            Route::group(['prefix' => 'userposition'], function(){
                Route::get('','SettingDashboardUserPositionController@Index')->name('setting.dashboard.userposition');           
                Route::get('create','SettingDashboardUserPositionController@Create')->name('setting.dashboard.userposition.create'); 
                Route::post('createsave','SettingDashboardUserPositionController@CreateSave')->name('setting.dashboard.userposition.createsave'); 
                Route::get('edit/{id}','SettingDashboardUserPositionController@Edit')->name('setting.dashboard.userposition.edit'); 
                Route::post('editsave/{id}','SettingDashboardUserPositionController@EditSave')->name('setting.dashboard.userposition.editsave'); 
                Route::get('delete/{id}','SettingDashboardUserPositionController@Delete')->name('setting.dashboard.userposition.delete'); 
            });

        }); 
        Route::group(['prefix' => 'website'], function(){
           //setting ของ website
            Route::group(['prefix' => 'pagestatus'], function(){
                Route::get('','SettingWebsitePageStatusController@Index')->name('setting.website.pagestatus');           
                Route::get('create','SettingWebsitePageStatusController@Create')->name('setting.website.pagestatus.create'); 
                Route::post('createsave','SettingWebsitePageStatusController@CreateSave')->name('setting.website.pagestatus.createsave'); 
                Route::get('edit/{id}','SettingWebsitePageStatusController@Edit')->name('setting.website.pagestatus.edit'); 
                Route::post('editsave/{id}','SettingWebsitePageStatusController@EditSave')->name('setting.website.pagestatus.editsave'); 
                Route::get('delete/{id}','SettingWebsitePageStatusController@Delete')->name('setting.website.pagestatus.delete'); 
            });
            Route::group(['prefix' => 'pagecategory'], function(){
                Route::get('','SettingWebsitePageCategoryController@Index')->name('setting.website.pagecategory');           
                Route::get('create','SettingWebsitePageCategoryController@Create')->name('setting.website.pagecategory.create'); 
                Route::post('createsave','SettingWebsitePageCategoryController@CreateSave')->name('setting.website.pagecategory.createsave'); 
                Route::get('edit/{id}','SettingWebsitePageCategoryController@Edit')->name('setting.website.pagecategory.edit'); 
                Route::post('editsave/{id}','SettingWebsitePageCategoryController@EditSave')->name('setting.website.pagecategory.editsave'); 
                Route::get('delete/{id}','SettingWebsitePageCategoryController@Delete')->name('setting.website.pagecategory.delete'); 
            });
            Route::group(['prefix' => 'faqcategory'], function(){
                Route::get('','SettingWebsiteFaqCategoryController@Index')->name('setting.website.faqcategory');           
                Route::get('create','SettingWebsiteFaqCategoryController@Create')->name('setting.website.faqcategory.create'); 
                Route::post('createsave','SettingWebsiteFaqCategoryController@CreateSave')->name('setting.website.faqcategory.createsave'); 
                Route::get('edit/{id}','SettingWebsiteFaqCategoryController@Edit')->name('setting.website.faqcategory.edit'); 
                Route::post('editsave/{id}','SettingWebsiteFaqCategoryController@EditSave')->name('setting.website.faqcategory.editsave'); 
                Route::get('delete/{id}','SettingWebsiteFaqCategoryController@Delete')->name('setting.website.faqcategory.delete'); 
            });
            Route::group(['prefix' => 'tag'], function(){
                Route::get('','SettingWebsiteTagController@Index')->name('setting.website.tag');           
                Route::get('create','SettingWebsiteTagController@Create')->name('setting.website.tag.create'); 
                Route::post('createsave','SettingWebsiteTagController@CreateSave')->name('setting.website.tag.createsave'); 
                Route::get('edit/{id}','SettingWebsiteTagController@Edit')->name('setting.website.tag.edit'); 
                Route::post('editsave/{id}','SettingWebsiteTagController@EditSave')->name('setting.website.tag.editsave'); 
                Route::get('delete/{id}','SettingWebsiteTagController@Delete')->name('setting.website.tag.delete'); 
            });
            
        }); 
        Route::group(['prefix' => 'company'], function(){
            Route::get('edit/{userid}','SettingCompanyController@Edit')->name('setting.company.edit');           
            Route::post('editsave/{id}','SettingCompanyController@EditSave')->name('setting.company.editsave'); 
        });
        Route::group(['prefix' => 'user'], function(){
            Route::get('','SettingUserController@Index')->name('setting.user');           
            Route::get('create','SettingUserController@Create')->name('setting.user.create'); 
            Route::post('createsave','SettingUserController@CreateSave')->name('setting.user.createsave'); 
            Route::get('edit/{id}','SettingUserController@Edit')->name('setting.user.edit'); 
            Route::post('editsave/{id}','SettingUserController@EditSave')->name('setting.user.editsave'); 
            Route::get('delete/{id}','SettingUserController@Delete')->name('setting.user.delete'); 
            Route::get('profile/{userid}','SettingUserController@Profile')->name('setting.user.profile'); 
        });
        Route::group(['prefix' => 'profile'], function(){
            Route::get('edit/{userid}','SettingProfileController@Edit')->name('setting.profile.edit'); 
        });
    });   
});  

Route::group(['prefix' => 'line'], function(){
    Route::get('','LineSubScribeController@Index')->name('line');        
    Route::get('linesubscribe/{id}', 'LineSubScribeController@LineSubcribe')->name('line.subcribe');
    Route::get('linecallback', 'LineSubScribeController@LineCallback')->name('line.callback');
    Route::get('linesend', 'LineSubScribeController@LineSend')->name('line.send');           
}); 


