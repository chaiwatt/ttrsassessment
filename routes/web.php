<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/term', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('generate','PDFController@Generate')->name('generate');

Route::get('', 'HomeController@Index')->name('landing.index');
Route::get('front', 'HomeController@Front')->name('landing.front');
Route::get('page/{slug}', 'HomeController@Page')->name('landing.page');
Route::get('tag/{slug}', 'HomeController@Tag')->name('landing.tag');
Route::get('cate/{slug}', 'HomeController@Category')->name('landing.cate');
Route::get('search', 'HomeController@Search')->name('landing.search');
Route::get('change/{locale}', 'LanguageController@Change')->name('change');

Route::group(['prefix' => 'email'], function(){
    Route::get('send','MailController@Send')->name('mail.send');
});

Route::group(['prefix' => 'social'], function(){       
    Route::get('/{provider}', 'Auth\LoginController@Redirect')->name('social.login');
    Route::get('callback/{provider}', 'Auth\LoginController@Callback')->name('social.callback');
});

Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'alert'], function(){
        Route::post('delete','Api\AlertController@Delete')->name('api.alert.delete');            
    });  
    Route::group(['prefix' => 'location'], function(){
        Route::post('province','Api\LocationController@Province')->name('api.location.province');           
        Route::post('amphur','Api\LocationController@Amphur')->name('api.location.amphur'); 
        Route::post('tambol','Api\LocationController@Tambol')->name('api.location.tambol'); 
    });  
    Route::group(['prefix' => 'tinpin'], function(){
        Route::post('companyinfo','Api\TinPinController@CompanyInfo')->name('api.tinpin.companyinfo');            
    });  
    Route::group(['prefix' => 'sms'], function(){
        Route::post('send','Api\SMSController@Send')->name('api.sms.send');           
        Route::post('saveotp','Api\SMSController@SaveOtp')->name('api.sms.saveotp'); 
    }); 
    Route::group(['prefix' => 'profile'], function(){
        Route::post('uploadcanvassignature','Api\ProfileController@UploadCanvasSignature')->name('api.profile.uploadcanvassignature');           
        Route::post('uploadsignature','Api\ProfileController@UploadSignature')->name('api.profile.uploadsignature');           
    }); 
}); 

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'api'], function(){
        Route::group(['prefix' => 'message'], function(){
            Route::post('getmessage','Api\MessageController@GetMessage')->name('api.message.getmessage');   
            Route::post('uploadattachment','Api\MessageController@UploadAttachment')->name('api.message.uploadattachment');   
            Route::post('deleteattachment','Api\MessageController@DeleteAttachment')->name('api.message.deleteattachment');       
        });
        Route::group(['prefix' => 'menu'], function(){
            Route::post('getmenu','Api\MenuController@GetMenu')->name('api.menu.getmenu');           
        });
        Route::group(['prefix' => 'category'], function(){
            Route::post('getcategory','Api\CategoryController@GetCategory')->name('api.category.getcategory');           
        });
        Route::group(['prefix' => 'pagecategory'], function(){
            Route::post('add','Api\PageCategoryController@Add')->name('api.pagecategory.add');           
            Route::post('edit','Api\PageCategoryController@Edit')->name('api.pagecategory.edit');  
            Route::post('delete','Api\PageCategoryController@Delete')->name('api.pagecategory.delete');  
        });
        Route::group(['prefix' => 'pagetag'], function(){
            Route::post('add','Api\PagetagController@Add')->name('api.pagetag.add');           
            Route::post('edit','Api\PagetagController@Edit')->name('api.pagetag.edit');  
            Route::post('delete','Api\PagetagController@Delete')->name('api.pagetag.delete');  
        });
        Route::group(['prefix' => 'layout'], function(){
            Route::post('edit','Api\LayoutController@Edit')->name('api.layout.edit');           
        });
        Route::group(['prefix' => 'gallery'], function(){
            Route::post('upload','Api\GalleryController@Upload')->name('api.gallery.upload');    
            Route::post('delete','Api\GalleryController@Delete')->name('api.gallery.delete');         
        });
        Route::group(['prefix' => 'feature'], function(){
            Route::post('upload','Api\FeatureController@Upload')->name('api.feature.upload');    
            Route::post('delete','Api\FeatureController@Delete')->name('api.feature.delete');         
        });
        Route::group(['prefix' => 'expert'], function(){
            Route::post('deleteexperience','Api\ExpertController@DeleteExperience')->name('api.expert.deleteexperience');    
            Route::post('deleteeducation','Api\ExpertController@DeleteEducation')->name('api.expert.deleteeducation');         
        });
        Route::group(['prefix' => 'businessplan'], function(){
            Route::group(['prefix' => 'status'], function(){
                Route::post('update','Api\BusinessPlanController@Update')->name('api.businessplan.update');          
            });
        });
        Route::group(['prefix' => 'coverimage'], function(){
            Route::post('add','Api\CoverImageController@Add')->name('api.coverimage.add');          
        });
        Route::group(['prefix' => 'friend'], function(){
            Route::post('addrequest','Api\FriendController@AddRequest')->name('api.friend.addrequest');   
            Route::post('deleterequest','Api\FriendController@DeleteRequest')->name('api.friend.deleterequest');        
            Route::post('acceptrequest','Api\FriendController@AcceptRequest')->name('api.friend.acceptrequest'); 
            Route::post('rejectrequest','Api\FriendController@RejectRequest')->name('api.friend.rejectrequest'); 
            Route::post('deletefriend','Api\FriendController@DeleteFriend')->name('api.friend.deletefriend'); 
        });
        Route::group(['prefix' => 'assessment'], function(){
            Route::post('add','Api\AssessmentController@Add')->name('api.assessment.add');     
            Route::group(['prefix' => 'cluster'], function(){
                Route::post('get','Api\AssessmentClusterController@Get')->name('api.assessment.ev.get');          
            });  
            Route::group(['prefix' => 'subcluster'], function(){
                Route::post('get','Api\AssessmentSubclusterController@Get')->name('api.assessment.subcluster.get');          
            });    
            Route::group(['prefix' => 'extrafactor'], function(){
                Route::post('get','Api\AssessmentExtrafactorController@Get')->name('api.assessment.extrafactor.get');          
            });  
            Route::group(['prefix' => 'subextrafactor'], function(){
                Route::post('get','Api\AssessmentSubExtrafactorController@Get')->name('api.assessment.subextrafactor.get');          
            });  
            Route::group(['prefix' => 'clustertransaction'], function(){
                Route::post('add','Api\AssessmentClusterTransactionController@Add')->name('api.assessment.clustertransaction.add');          
            });  
            Route::group(['prefix' => 'ev'], function(){
                Route::post('addevchecklist','Api\AssessmentEvController@AddEvChecklist')->name('api.assessment.ev.addevchecklist');          
                Route::post('addevgrading','Api\AssessmentEvController@AddEvGrading')->name('api.assessment.ev.addevgrading'); 
                Route::post('getev','Api\AssessmentEvController@GetEv')->name('api.assessment.ev.getev'); 
                Route::post('getevbyfulltbp','Api\AssessmentEvController@GetEvByFulltbp')->name('api.assessment.ev.getevbyfulltbp'); 
                Route::post('copyev','Api\AssessmentEvController@CopyEv')->name('api.assessment.ev.copyev'); 
                Route::post('updateevstatus','Api\AssessmentEvController@UpdateEvStatus')->name('api.assessment.ev.updateevstatus'); 
                Route::post('updateadminevstatus','Api\AssessmentEvController@UpdateAdminEvStatus')->name('api.assessment.ev.updateadminevstatus');
                Route::post('editapprove','Api\AssessmentEvController@EditApprove')->name('api.assessment.ev.editapprove');
                Route::group(['prefix' => 'pillar'], function(){
                    Route::post('getpillar','Api\AssessmentEvPillarController@GetPillar')->name('api.assessment.ev.pillar.getpillar');          
                    Route::post('deletepillar','Api\AssessmentEvPillarController@DeletePillar')->name('api.assessment.ev.pillar.deletepillar'); 
                    Route::post('getrelatedev','Api\AssessmentEvPillarController@GetRelatedEv')->name('api.assessment.ev.pillar.getrelatedev'); 
                }); 
                Route::group(['prefix' => 'subpillar'], function(){
                    Route::post('getsubpillar','Api\AssessmentEvSubPillarController@GetSubpillar')->name('api.assessment.ev.subpillar.getsubpillar');          
                    Route::post('addsubpillar','Api\AssessmentEvSubPillarController@AddSubpillar')->name('api.assessment.ev.subpillar.addsubpillar');          
                    Route::post('editsubpillar','Api\AssessmentEvSubPillarController@EditSubpillar')->name('api.assessment.ev.subpillar.editsubpillar');          
                    Route::post('getsubpillarindex','Api\AssessmentEvSubPillarController@GetSubPillarIndex')->name('api.assessment.ev.subpillar.getsubpillarindex');          
                    Route::post('addsubpillarindex','Api\AssessmentEvSubPillarController@AddSubPillarIndex')->name('api.assessment.ev.subpillar.addsubpillarindex');          
                    Route::post('editsubpillarindex','Api\AssessmentEvSubPillarController@EditSubPillarIndex')->name('api.assessment.ev.subpillar.editsubpillarindex');          
                    Route::post('getcriteria','Api\AssessmentEvSubPillarController@GetCriteria')->name('api.assessment.ev.subpillar.getcriteria');          
                    Route::post('addcriteria','Api\AssessmentEvSubPillarController@AddCriteria')->name('api.assessment.ev.subpillar.addcriteria');          
                    Route::post('editcriteria','Api\AssessmentEvSubPillarController@EditCriteria')->name('api.assessment.ev.subpillar.editcriteria');          
                    Route::post('deletesubpillar','Api\AssessmentEvSubPillarController@DeleteSubPillar')->name('api.assessment.ev.subpillar.deletesubpillar'); 
                    Route::post('deletesubpillarindex','Api\AssessmentEvSubPillarController@DeleteSubPillarIndex')->name('api.assessment.ev.subpillar.deletesubpillarindex'); 
                    Route::post('getrelatedev','Api\AssessmentEvSubPillarController@GetRelatedEv')->name('api.assessment.ev.subpillar.getrelatedev'); 
                }); 
                Route::group(['prefix' => 'pillarindexweigth'], function(){
                    Route::post('getweigth','Api\AssessmentEvPillarIndexWeigthController@GetWeigth')->name('api.assessment.ev.pillarindexweigth.getweigth');          
                    Route::post('editweigth','Api\AssessmentEvPillarIndexWeigthController@EditWeigth')->name('api.assessment.ev.pillarindexweigth.editweigth');          
                }); 
            });  
        });
        Route::group(['prefix' => 'hid'], function(){
            Route::post('check','Api\HidController@Check')->name('api.hid.check');           
        }); 
        Route::group(['prefix' => 'fulltbp'], function(){
            Route::group(['prefix' => 'companyprofile'], function(){
                Route::post('add','Api\FullTbpCompanyProfileController@CompanyprofileAdd')->name('api.fulltbp.companyprofile.add');           
                Route::group(['prefix' => 'attachement'], function(){
                    Route::post('add','Api\FullTbpCompanyProfileAttachmentController@Add')->name('api.fulltbp.companyprofile.attachement.add');           
                    Route::post('delete','Api\FullTbpCompanyProfileAttachmentController@Delete')->name('api.fulltbp.companyprofile.attachement.delete');           
                });  
            }); 
            Route::group(['prefix' => 'ceo'], function(){
                Route::post('add','Api\FullTbpCompanyCEOController@Add')->name('api.fulltbp.ceo.add');           
                Route::post('get','Api\FullTbpCompanyCEOController@Get')->name('api.fulltbp.ceo.get');  
                Route::post('edit','Api\FullTbpCompanyCEOController@Edit')->name('api.fulltbp.ceo.edit');  
            });
            Route::group(['prefix' => 'employ'], function(){
                Route::post('add','Api\FullTbpCompanyEmployController@Add')->name('api.fulltbp.employ.add');    
                Route::post('delete','Api\FullTbpCompanyEmployController@Delete')->name('api.fulltbp.employ.delete');       
                Route::post('get','Api\FullTbpCompanyEmployController@Get')->name('api.fulltbp.employ.get');  
                Route::post('edit','Api\FullTbpCompanyEmployController@Edit')->name('api.fulltbp.employ.edit'); 
                Route::post('getlist','Api\FullTbpCompanyEmployController@GetList')->name('api.fulltbp.employ.getlist'); 

                Route::group(['prefix' => 'education'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployEducationController@Add')->name('api.fulltbp.employ.education.add');           
                    Route::post('delete','Api\FullTbpCompanyEmployEducationController@Delete')->name('api.fulltbp.employ.education.delete'); 
                }); 
                Route::group(['prefix' => 'experience'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployExperienceController@Add')->name('api.fulltbp.employ.experience.add');           
                    Route::post('delete','Api\FullTbpCompanyEmployExperienceController@Delete')->name('api.fulltbp.employ.experience.delete'); 
                }); 
                Route::group(['prefix' => 'training'], function(){
                    Route::post('add','Api\FullTbpCompanyEmployTrainingController@Add')->name('api.fulltbp.employ.training.add');  
                    Route::post('delete','Api\FullTbpCompanyEmployTrainingController@Delete')->name('api.fulltbp.employ.training.delete');          
                });
                Route::group(['prefix' => 'quantity'], function(){
                    Route::post('edit','Api\FullTbpCompanyEmployQuantityController@Edit')->name('api.fulltbp.employ.quantity.edit');  
                });
            }); 
            
            Route::group(['prefix' => 'stockholder'], function(){
                Route::post('add','Api\FullTbpCompanyStockHolderController@Add')->name('api.fulltbp.stockholder.add');           
                Route::post('delete','Api\FullTbpCompanyStockHolderController@Delete')->name('api.fulltbp.stockholder.delete');  
            });
            Route::group(['prefix' => 'project'], function(){
                Route::group(['prefix' => 'abtract'], function(){
                    Route::post('add','Api\FullTbpProjectAbtractController@Add')->name('api.fulltbp.project.abtract.add');           
                });
                Route::group(['prefix' => 'product'], function(){
                    Route::post('add','Api\FullTbpProjectProductController@Add')->name('api.fulltbp.project.product.add');           
                });
                Route::group(['prefix' => 'productdetail'], function(){
                    Route::post('add','Api\FullTbpProductDetailController@Add')->name('api.fulltbp.project.productdetail.add');           
                });
                Route::group(['prefix' => 'techdev'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevController@Add')->name('api.fulltbp.project.techdev.add');           
                });
                Route::group(['prefix' => 'techdevlevel'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevLevelController@Add')->name('api.fulltbp.project.techdevlevel.add');           
                    Route::post('delete','Api\FullTbpProjectTechDevLevelController@Delete')->name('api.fulltbp.project.techdevlevel.delete');           
                });
                Route::group(['prefix' => 'techdevproblem'], function(){
                    Route::post('add','Api\FullTbpProjectTechDevProblemController@Add')->name('api.fulltbp.project.techdevproblem.add');           
                });
                Route::group(['prefix' => 'projectcertify'], function(){
                    Route::post('edit','Api\FullTbpProjectCertifyController@Edit')->name('api.fulltbp.project.projectcertify.edit');           
                    Route::group(['prefix' => 'upload'], function(){
                        Route::post('add','Api\FullTbpProjectCertifyUploadController@Add')->name('api.fulltbp.project.projectcertify.upload.add');           
                        Route::post('delete','Api\FullTbpProjectCertifyUploadController@Delete')->name('api.fulltbp.project.projectcertify.upload.delete');  
                    });
                });
                Route::group(['prefix' => 'projectaward'], function(){
                    Route::post('add','Api\FullTbpProjectAwardController@Add')->name('api.fulltbp.project.projectaward.add');           
                    Route::post('delete','Api\FullTbpProjectAwardController@Delete')->name('api.fulltbp.project.projectaward.delete');
                });
                Route::group(['prefix' => 'standard'], function(){
                    Route::post('add','Api\FullTbpProjectStandardController@Add')->name('api.fulltbp.project.standard.add');
                    Route::post('edit','Api\FullTbpProjectStandardController@Edit')->name('api.fulltbp.project.standard.edit');           
                    Route::post('delete','Api\FullTbpProjectStandardController@Delete')->name('api.fulltbp.project.standard.delete');
                });
                Route::group(['prefix' => 'plan'], function(){
                    Route::post('add','Api\FullTbpProjectPlanController@Add')->name('api.fulltbp.project.plan.add');
                    Route::post('get','Api\FullTbpProjectPlanController@Get')->name('api.fulltbp.project.plan.get'); 
                    Route::post('edit','Api\FullTbpProjectPlanController@Edit')->name('api.fulltbp.project.plan.edit');           
                    Route::post('delete','Api\FullTbpProjectPlanController@Delete')->name('api.fulltbp.project.plan.delete');
                });
            }); 
            Route::group(['prefix' => 'market'], function(){
                Route::group(['prefix' => 'need'], function(){
                    Route::post('add','Api\FullTbpMarketNeedController@Add')->name('api.fulltbp.market.need.add');           
                });
                Route::group(['prefix' => 'size'], function(){
                    Route::post('add','Api\FullTbpMarketSizeController@Add')->name('api.fulltbp.market.size.add');           
                });
                Route::group(['prefix' => 'share'], function(){
                    Route::post('add','Api\FullTbpMarketShareController@Add')->name('api.fulltbp.market.share.add');           
                });
                Route::group(['prefix' => 'competitive'], function(){
                    Route::post('add','Api\FullTbpMarketCompetitiveController@Add')->name('api.fulltbp.market.competitive.add');           
                });
                Route::group(['prefix' => 'attachment'], function(){
                    Route::post('add','Api\FullTbpMarketAttachmentController@Add')->name('api.fulltbp.market.attachment.add');           
                    Route::post('delete','Api\FullTbpMarketAttachmentController@Delete')->name('api.fulltbp.market.attachment.delete');            
                });
            });
            Route::group(['prefix' => 'sell'], function(){
                Route::post('add','Api\FullTbpSellController@Add')->name('api.fulltbp.sell.add');           
                Route::post('delete','Api\FullTbpSellController@Delete')->name('api.fulltbp.sell.delete'); 
                Route::post('get','Api\FullTbpSellController@Get')->name('api.fulltbp.sell.get'); 
                Route::post('edit','Api\FullTbpSellController@Edit')->name('api.fulltbp.sell.edit');
            });
            Route::group(['prefix' => 'sellstatus'], function(){
                Route::post('get','Api\FullTbpSellStatusController@Get')->name('api.fulltbp.sellstatus.get'); 
                Route::post('edit','Api\FullTbpSellStatusController@Edit')->name('api.fulltbp.sellstatus.edit');
            });
            Route::group(['prefix' => 'debtpartner'], function(){
                Route::post('add','Api\FullTbpDebtPartnerController@Add')->name('api.fulltbp.debtpartner.add'); 
                Route::post('get','Api\FullTbpDebtPartnerController@Get')->name('api.fulltbp.debtpartner.get'); 
                Route::post('delete','Api\FullTbpDebtPartnerController@Delete')->name('api.fulltbp.debtpartner.delete'); 
                Route::post('edit','Api\FullTbpDebtPartnerController@Edit')->name('api.fulltbp.debtpartner.edit');
            });
            Route::group(['prefix' => 'creditpartner'], function(){
                Route::post('add','Api\FullTbpCreditPartnerController@Add')->name('api.fulltbp.creditpartner.add'); 
                Route::post('get','Api\FullTbpCreditPartnerController@Get')->name('api.fulltbp.creditpartner.get'); 
                Route::post('delete','Api\FullTbpCreditPartnerController@Delete')->name('api.fulltbp.creditpartner.delete'); 
                Route::post('edit','Api\FullTbpCreditPartnerController@Edit')->name('api.fulltbp.creditpartner.edit');
            });
            Route::group(['prefix' => 'asset'], function(){
                Route::post('get','Api\FullTbpAssetController@Get')->name('api.fulltbp.asset.get'); 
                Route::post('edit','Api\FullTbpAssetController@Edit')->name('api.fulltbp.asset.edit');
            });
            Route::group(['prefix' => 'investment'], function(){
                Route::post('get','Api\FullTbpInvestmentController@Get')->name('api.fulltbp.investment.get'); 
                Route::post('edit','Api\FullTbpInvestmentController@Edit')->name('api.fulltbp.investment.edit');
            });
            Route::group(['prefix' => 'cost'], function(){
                Route::post('get','Api\FullTbpCostController@Get')->name('api.fulltbp.cost.get'); 
                Route::post('edit','Api\FullTbpCostController@Edit')->name('api.fulltbp.cost.edit');
            });
            Route::group(['prefix' => 'roi'], function(){
                Route::post('edit','Api\FullTbpROIController@Edit')->name('api.fulltbp.roi.edit');
            });
            Route::group(['prefix' => 'companydoc'], function(){
                Route::post('add','Api\FullTbpCompanyDocController@Add')->name('api.fulltbp.companydoc.add');
                Route::post('delete','Api\FullTbpCompanyDocController@Delete')->name('api.fulltbp.companydoc.delete');
            });
        }); 
        Route::group(['prefix' => 'googlecalendar'], function(){
            Route::post('getevents','Api\GoogleCalendarController@GetEvents')->name('api.googlecalendar.getevents');
        });
        
    }); 
    Route::group(['prefix' => 'dashboard'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::group(['prefix' => 'report'], function(){
                Route::get('','DashboardAdminReportController@Index')->name('dashboard.admin.report');           
                Route::post('getevent','DashboardAdminReportController@GetEvent')->name('dashboard.admin.getevent'); 
                Route::group(['prefix' => 'search'], function(){
                    Route::get('','DashboardAdminReportSearchController@Index')->name('dashboard.admin.report.search');    
                    Route::post('getsearch','DashboardAdminReportSearchController@GetSearch')->name('dashboard.admin.report.search.getsearch');          
                    Route::get('view/{id}','DashboardAdminReportSearchViewController@View')->name('dashboard.admin.report.search.view');          
                    Route::get('pdf/{id}','DashboardAdminReportSearchPdfController@Pdf')->name('dashboard.admin.report.search.pdf');          
                    Route::get('excel/{id}','DashboardAdminReportSearchExcelController@Excel')->name('dashboard.admin.report.search.excel');          
                });
            }); 
            Route::group(['prefix' => 'project'], function(){
                Route::group(['prefix' => 'fee'], function(){
                    Route::get('','DashboardAdminProjectFeeController@Index')->name('dashboard.admin.project.fee');           
                });       
                Route::group(['prefix' => 'businessplan'], function(){
                    Route::get('','DashboardAdminProjectBusinessPlanController@Index')->name('dashboard.admin.project.businessplan');           
                    Route::get('view/{id}','DashboardAdminProjectBusinessPlanController@View')->name('dashboard.admin.project.businessplan.view'); 
                    Route::get('delete/{id}','DashboardAdminProjectBusinessPlanController@Delete')->name('dashboard.admin.project.businessplan.delete'); 
                });     
                Route::group(['prefix' => 'minitbp'], function(){
                    Route::get('','DashboardAdminProjectMiniTbpController@Index')->name('dashboard.admin.project.minitbp');           
                    Route::get('view/{id}','DashboardAdminProjectMiniTbpController@View')->name('dashboard.admin.project.minitbp.view');  
                    Route::get('approve/{id}','DashboardAdminProjectMiniTbpController@Approve')->name('dashboard.admin.project.minitbp.approve');    
                    Route::get('delete/{id}','DashboardAdminProjectMiniTbpController@Delete')->name('dashboard.admin.project.minitbp.delete');  
                    Route::post('editapprove','DashboardAdminProjectMiniTbpController@EditApprove')->name('dashboard.admin.project.minitbp.editapprove');    
                });  
                Route::group(['prefix' => 'fulltbp'], function(){
                    Route::get('','DashboardAdminProjectFullTbpController@Index')->name('dashboard.admin.project.fulltbp');            
                    Route::get('view/{id}','DashboardAdminProjectFullTbpController@View')->name('dashboard.admin.project.fulltbp.view');  
                    Route::post('delete/{id}','DashboardAdminProjectFullTbpController@Delete')->name('dashboard.admin.project.fulltbp.delete');  
                    Route::get('assigngroup/{id}','DashboardAdminProjectFullTbpController@AssignGroup')->name('dashboard.admin.project.fulltbp.assigngroup');           
                    Route::post('assigngroupsave/{id}','DashboardAdminProjectFullTbpController@AssignGroupSave')->name('dashboard.admin.project.fulltbp.assigngroupsave');                     
                    Route::get('assignexpert/{id}','DashboardAdminProjectFullTbpController@AssignExpert')->name('dashboard.admin.project.fulltbp.assignexpert');           
                    Route::post('assignexpertsave','DashboardAdminProjectFullTbpController@AssignExpertSave')->name('dashboard.admin.project.fulltbp.assignexpertsave');                     
                    Route::post('assignexpertdelete','DashboardAdminProjectFullTbpController@AssignExpertDelete')->name('dashboard.admin.project.fulltbp.assignexpertdelete');   
                    Route::post('editassignexpert','DashboardAdminProjectFullTbpController@EditAssignExpert')->name('dashboard.admin.project.fulltbp.editassignexpert');   
                    Route::post('getexpert','DashboardAdminProjectFullTbpController@GetExpert')->name('dashboard.admin.project.fulltbp.getexpert');   
                    Route::post('notifyjd','DashboardAdminProjectFullTbpController@NotifyJd')->name('dashboard.admin.project.fulltbp.notifyjd'); 
                    Route::post('editapprove','DashboardAdminProjectFullTbpController@EditApprove')->name('dashboard.admin.project.fulltbp.editapprove'); 
                    Route::get('viewev/{id}','DashboardAdminProjectFullTbpController@ViewEv')->name('dashboard.admin.project.fulltbp.viewev'); 
                    Route::get('createev/{id}','DashboardAdminProjectFullTbpController@CreateEv')->name('dashboard.admin.project.fulltbp.createev'); 
                    Route::post('createsaveev','DashboardAdminProjectFullTbpController@CreateSaveEv')->name('dashboard.admin.project.fulltbp.createsaveev'); 
                    Route::get('editev/{id}','DashboardAdminProjectFullTbpController@EditEv')->name('dashboard.admin.project.fulltbp.editev');
                    Route::post('editsaveev/{id}','DashboardAdminProjectFullTbpController@EditSaveEv')->name('dashboard.admin.project.fulltbp.editsaveev');
                    Route::get('deleteev/{id}','DashboardAdminProjectFullTbpController@DeleteEv')->name('dashboard.admin.project.fulltbp.deleteev');
                    Route::post('getusers','DashboardAdminProjectFullTbpController@GetUsers')->name('dashboard.admin.project.fulltbp.getusers');
                    Route::post('addprojectmember','DashboardAdminProjectFullTbpController@AddProjectMember')->name('dashboard.admin.project.fulltbp.addprojectmember');
                    Route::post('deleteprojectmember','DashboardAdminProjectFullTbpController@DeleteProjectMember')->name('dashboard.admin.project.fulltbp.deleteprojectmember');
                    Route::group(['prefix' => 'admin'], function(){
                        Route::get('','DashboardAdminProjectFullTbpAdminController@Index')->name('dashboard.admin.project.fulltbp.admin');           
                        Route::get('editev/{id}','DashboardAdminProjectFullTbpAdminController@EditEv')->name('dashboard.admin.project.fulltbp.admin.editev');
                        Route::post('addevedithistory/{id}','DashboardAdminProjectFullTbpAdminController@AddEvEditHistory')->name('dashboard.admin.project.fulltbp.admin.addevedithistory');
                    }); 
                    Route::group(['prefix' => 'jd'], function(){
                        Route::get('','DashboardAdminProjectFullTbpJdController@Index')->name('dashboard.admin.project.fulltbp.jd');           
                        Route::get('editev/{id}','DashboardAdminProjectFullTbpJdController@EditEv')->name('dashboard.admin.project.fulltbp.jd.editev');           
                    });
                }); 
                Route::group(['prefix' => 'projectassignment'], function(){
                    Route::get('','DashboardAdminProjectProjectAssignmentController@Index')->name('dashboard.admin.project.projectassignment');           
                    Route::get('edit/{id}','DashboardAdminProjectProjectAssignmentController@Edit')->name('dashboard.admin.project.projectassignment.edit');  
                    Route::post('editsave/{id}','DashboardAdminProjectProjectAssignmentController@EditSave')->name('dashboard.admin.project.projectassignment.editsave');    
                    Route::post('getworkloadleader','DashboardAdminProjectProjectAssignmentController@GetWorkLoadLeader')->name('dashboard.admin.project.projectassignment.getworkloadleader');    
                    Route::post('getworkloadcoleader','DashboardAdminProjectProjectAssignmentController@GetWorkLoadCoLeader')->name('dashboard.admin.project.projectassignment.getworkloadcoleader');                       
                }); 
                Route::group(['prefix' => 'evweight'], function(){
                    Route::get('','DashboardAdminProjectEvWeightController@Index')->name('dashboard.admin.project.evweight');           
                    Route::get('edit/{id}','DashboardAdminProjectEvWeightController@Edit')->name('dashboard.admin.project.evweight.edit');
                    Route::post('editsave','DashboardAdminProjectEvWeightController@EditSave')->name('dashboard.admin.project.evweight.editsave');
                    Route::post('getev','DashboardAdminProjectEvWeightController@GetEv')->name('dashboard.admin.project.evweight.getev');
                    
                }); 
                Route::group(['prefix' => 'assessment'], function(){
                    Route::get('','DashboardAdminProjectAssessmentController@Index')->name('dashboard.admin.project.assessment');           
                    Route::get('edit/{id}','DashboardAdminProjectAssessmentController@Edit')->name('dashboard.admin.project.assessment.edit');
                    Route::post('getev','DashboardAdminProjectAssessmentController@GetEv')->name('dashboard.admin.project.assessment.getev'); 
                    Route::post('editsave/{id}','DashboardAdminProjectAssessmentController@EditSave')->name('dashboard.admin.project.assessment.editsave');
                    Route::post('editscore','DashboardAdminProjectAssessmentController@EditScore')->name('dashboard.admin.project.assessment.editscore');
                    Route::post('editcomment','DashboardAdminProjectAssessmentController@EditComment')->name('dashboard.admin.project.assessment.editcomment');
                    Route::post('updatescoringstatus','DashboardAdminProjectAssessmentController@UpdateScoringStatus')->name('dashboard.admin.project.assessment.updatescoringstatus');
                    
                }); 
            });  
            Route::group(['prefix' => 'calendar'], function(){
                Route::get('','DashboardAdminCalendarController@Index')->name('dashboard.admin.calendar');           
                Route::get('create','DashboardAdminCalendarController@Create')->name('dashboard.admin.calendar.create'); 
                Route::post('createsave','DashboardAdminCalendarController@CreateSave')->name('dashboard.admin.calendar.createsave');
                Route::get('edit/{id}','DashboardAdminCalendarController@Edit')->name('dashboard.admin.calendar.edit'); 
                Route::post('editsave/{id}','DashboardAdminCalendarController@EditSave')->name('dashboard.admin.calendar.editsave'); 
                Route::get('delete/{id}','DashboardAdminCalendarController@Delete')->name('dashboard.admin.calendar.delete'); 
            }); 
            Route::group(['prefix' => 'assessment'], function(){
                Route::get('','DashboardAdminAssessmentController@Index')->name('dashboard.admin.assessment');     
                Route::get('edit/{id}','DashboardAdminAssessmentController@Edit')->name('dashboard.admin.assessment.edit');        
                Route::post('getev','DashboardAdminAssessmentController@GetEv')->name('dashboard.admin.assessment.getev'); 
                Route::post('addscore','DashboardAdminAssessmentController@AddScore')->name('dashboard.admin.assessment.addscore'); 
                Route::post('conflictscore','DashboardAdminAssessmentController@ConflictScore')->name('dashboard.admin.assessment.conflictscore'); 
                Route::post('conflictgrade','DashboardAdminAssessmentController@ConflictGrade')->name('dashboard.admin.assessment.conflictgrade'); 
                Route::post('pendinguser','DashboardAdminAssessmentController@PendingUser')->name('dashboard.admin.assessment.pendinguser');
            }); 
        }); 
        Route::group(['prefix' => 'expert'], function(){
            Route::get('','DashboardExpertController@Index')->name('dashboard.expert');  
            Route::group(['prefix' => 'project'], function(){
                // Route::get('','DashboardExpertFullTbpController@Index')->name('dashboard.expert.fulltbp');   
                // Route::get('view/{id}','DashboardExpertFullTbpController@View')->name('dashboard.expert.fulltbp.view');  
                Route::group(['prefix' => 'fulltbp'], function(){
                    Route::get('','DashboardExpertProjectFullTbpController@Index')->name('dashboard.expert.project.fulltbp');   
                    Route::get('view/{id}','DashboardExpertProjectFullTbpController@View')->name('dashboard.expert.project.fulltbp.view');   
                    Route::post('editaccept','DashboardExpertProjectFullTbpController@EditAccept')->name('dashboard.expert.project.fulltbp.editaccept');    
                });   
                Route::group(['prefix' => 'assessment'], function(){
                    Route::get('','DashboardExpertProjectAssessmentController@Index')->name('dashboard.expert.project.assessment');   
                    Route::get('edit/{id}','DashboardExpertProjectAssessmentController@Edit')->name('dashboard.expert.project.assessment.edit');
                    Route::post('editsave/{id}','DashboardExpertProjectAssessmentController@EditSave')->name('dashboard.expert.project.assessment.editsave');
                });    
                Route::group(['prefix' => 'comment'], function(){
                    Route::get('','DashboardExpertProjectCommentController@Index')->name('dashboard.expert.project.comment');   
                    Route::get('edit/{fulltbpid}','DashboardExpertProjectCommentController@Edit')->name('dashboard.expert.project.comment.edit');
                    Route::post('editsave/{fulltbpid}','DashboardExpertProjectCommentController@EditSave')->name('dashboard.expert.project.comment.editsave');
                }); 
            }); 
            
    
            Route::group(['prefix' => 'report'], function(){
                Route::get('','DashboardExpertReportController@Index')->name('dashboard.expert.report');   
                Route::get('view/{id}','DashboardExpertReportController@View')->name('dashboard.expert.report.view');          
                Route::get('pdf/{id}','DashboardExpertReportController@Pdf')->name('dashboard.expert.report.pdf');          
                Route::get('excel/{id}','DashboardExpertReportController@Excel')->name('dashboard.expert.report.excel');               
                Route::get('accept/{id}','DashboardExpertReportController@Accept')->name('dashboard.expert.report.accept'); 
                Route::get('reject/{id}','DashboardExpertReportController@Reject')->name('dashboard.expert.report.reject'); 
            });    
        }); 
        Route::group(['prefix' => 'company'], function(){
            Route::group(['prefix' => 'report'], function(){
                Route::get('','DashboardCompanyReportController@Index')->name('dashboard.company.report');    
                Route::post('getevent','DashboardCompanyReportController@GetEvent')->name('dashboard.company.report.getevent');         
                Route::post('gettimeline','DashboardCompanyReportController@GetTimeLine')->name('dashboard.company.report.gettimeline'); 
                Route::post('edittimelinestatus','DashboardCompanyReportController@EditTimeLineStatus')->name('dashboard.company.report.edittimelinestatus'); 
                
            });      
            Route::group(['prefix' => 'project'], function(){
                Route::group(['prefix' => 'assessment'], function(){
                    Route::get('','DashboardCompanyProjectAssessmentController@Index')->name('dashboard.company.assessment');           
                }); 
                Route::group(['prefix' => 'minitbp'], function(){
                    Route::get('','DashboardCompanyProjectMiniTBPController@Index')->name('dashboard.company.project.minitbp'); 
                    Route::get('edit/{id}','DashboardCompanyProjectMiniTBPController@Edit')->name('dashboard.company.project.minitbp.edit');           
                    Route::post('editsave/{id}','DashboardCompanyProjectMiniTBPController@EditSave')->name('dashboard.company.project.minitbp.editsave');   
                    Route::get('downloadpdf/{id}','DashboardCompanyProjectMiniTBPController@DownloadPDF')->name('dashboard.company.project.minitbp.downloadpdf'); 
                    Route::get('submit/{id}','DashboardCompanyProjectMiniTBPController@Submit')->name('dashboard.company.project.minitbp.submit'); 
                    Route::post('submitsave/{id}','DashboardCompanyProjectMiniTBPController@SubmitSave')->name('dashboard.company.project.minitbp.submitsave'); 
                }); 
                Route::group(['prefix' => 'fee'], function(){
                    Route::get('','DashboardCompanyProjectFeeController@Index')->name('dashboard.company.project.fee');           
                    Route::get('invoice/{id}','DashboardCompanyProjectFeeController@Invoice')->name('dashboard.company.project.fee.invoice');  
                    Route::get('payment/{id}','DashboardCompanyProjectFeeController@Payment')->name('dashboard.company.project.fee.payment'); 
                    Route::post('paymentsave/{id}','DashboardCompanyProjectFeeController@PaymentSave')->name('dashboard.company.project.fee.paymentsave'); 
                });  
                Route::group(['prefix' => 'fulltbp'], function(){
                    Route::get('','DashboardCompanyProjectFullTbpController@Index')->name('dashboard.company.project.fulltbp');  
                    Route::get('edit/{id}','DashboardCompanyProjectFullTbpController@Edit')->name('dashboard.company.project.fulltbp.edit');   
                    Route::post('editsave/{id}','DashboardCompanyProjectFullTbpController@EditSave')->name('dashboard.company.project.fulltbp.editsave');   
                    Route::get('downloadpdf/{id}','DashboardCompanyProjectFullTbpController@DownloadPDF')->name('dashboard.company.project.fulltbp.downloadpdf'); 
                    Route::get('submit/{id}','DashboardCompanyProjectFullTbpController@Submit')->name('dashboard.company.project.fulltbp.submit'); 
                    Route::post('submitsave/{id}','DashboardCompanyProjectFullTbpController@SubmitSave')->name('dashboard.company.project.fulltbp.submitsave');        
                }); 
            });       

        }); 
    });   
    Route::group(['prefix' => 'sms'], function(){
        Route::get('','SmsController@Index')->name('sms');  
        Route::get('send','SmsController@Send')->name('sms.send');           
        Route::get('credit','SmsController@Credit')->name('sms.credit');  
        Route::post('verify','SmsController@Verify')->name('sms.verify');
    });    
    Route::group(['prefix' => 'setting'], function(){
        Route::group(['prefix' => 'admin'], function(){
            Route::group(['prefix' => 'dashboard'], function(){
                Route::group(['prefix' => 'prefix'], function(){
                    Route::get('','SettingAdminDashboardPrefixController@Index')->name('setting.admin.dashboard.prefix');           
                    Route::get('create','SettingAdminDashboardPrefixController@Create')->name('setting.admin.dashboard.prefix.create'); 
                    Route::post('createsave','SettingAdminDashboardPrefixController@CreateSave')->name('setting.admin.dashboard.prefix.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardPrefixController@Edit')->name('setting.admin.dashboard.prefix.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardPrefixController@EditSave')->name('setting.admin.dashboard.prefix.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardPrefixController@Delete')->name('setting.admin.dashboard.prefix.delete'); 
                }); 
                Route::group(['prefix' => 'religion'], function(){
                    Route::get('','SettingAdminDashboardReligionController@Index')->name('setting.admin.dashboard.religion');           
                    Route::get('create','SettingAdminDashboardReligionController@Create')->name('setting.admin.dashboard.religion.create'); 
                    Route::post('createsave','SettingAdminDashboardReligionController@CreateSave')->name('setting.admin.dashboard.religion.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardReligionController@Edit')->name('setting.admin.dashboard.religion.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardReligionController@EditSave')->name('setting.admin.dashboard.religion.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardReligionController@Delete')->name('setting.admin.dashboard.religion.delete'); 
                });
                Route::group(['prefix' => 'country'], function(){
                    Route::get('','SettingAdminDashboardCountryController@Index')->name('setting.admin.dashboard.country');           
                    Route::get('create','SettingAdminDashboardCountryController@Create')->name('setting.admin.dashboard.country.create'); 
                    Route::post('createsave','SettingAdminDashboardCountryController@CreateSave')->name('setting.admin.dashboard.country.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardCountryController@Edit')->name('setting.admin.dashboard.country.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardCountryController@EditSave')->name('setting.admin.dashboard.country.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardCountryController@Delete')->name('setting.admin.dashboard.country.delete'); 
                });
                Route::group(['prefix' => 'educationbranch'], function(){
                    Route::get('','SettingAdminDashboardEducationBranchController@Index')->name('setting.admin.dashboard.educationbranch');           
                    Route::get('create','SettingAdminDashboardEducationBranchController@Create')->name('setting.admin.dashboard.educationbranch.create'); 
                    Route::post('createsave','SettingAdminDashboardEducationBranchController@CreateSave')->name('setting.admin.dashboard.educationbranch.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardEducationBranchController@Edit')->name('setting.admin.dashboard.educationbranch.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardEducationBranchController@EditSave')->name('setting.admin.dashboard.educationbranch.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardEducationBranchController@Delete')->name('setting.admin.dashboard.educationbranch.delete'); 
                });
                Route::group(['prefix' => 'educationlevel'], function(){
                    Route::get('','SettingAdminDashboardEducationLevelController@Index')->name('setting.admin.dashboard.educationlevel');           
                    Route::get('create','SettingAdminDashboardEducationLevelController@Create')->name('setting.admin.dashboard.educationlevel.create'); 
                    Route::post('createsave','SettingAdminDashboardEducationLevelController@CreateSave')->name('setting.admin.dashboard.educationlevel.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardEducationLevelController@Edit')->name('setting.admin.dashboard.educationlevel.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardEducationLevelController@EditSave')->name('setting.admin.dashboard.educationlevel.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardEducationLevelController@Delete')->name('setting.admin.dashboard.educationlevel.delete'); 
                });
                Route::group(['prefix' => 'businesstype'], function(){
                    Route::get('','SettingAdminDashboardBusinessTypeController@Index')->name('setting.admin.dashboard.businesstype');           
                    Route::get('create','SettingAdminDashboardBusinessTypeController@Create')->name('setting.admin.dashboard.businesstype.create'); 
                    Route::post('createsave','SettingAdminDashboardBusinessTypeController@CreateSave')->name('setting.admin.dashboard.businesstype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBusinessTypeController@Edit')->name('setting.admin.dashboard.businesstype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBusinessTypeController@EditSave')->name('setting.admin.dashboard.businesstype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBusinessTypeController@Delete')->name('setting.admin.dashboard.businesstype.delete'); 
                });
                Route::group(['prefix' => 'industrygroup'], function(){
                    Route::get('','SettingAdminDashboardIndustryGroupController@Index')->name('setting.admin.dashboard.industrygroup');           
                    Route::get('create','SettingAdminDashboardIndustryGroupController@Create')->name('setting.admin.dashboard.industrygroup.create'); 
                    Route::post('createsave','SettingAdminDashboardIndustryGroupController@CreateSave')->name('setting.admin.dashboard.industrygroup.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardIndustryGroupController@Edit')->name('setting.admin.dashboard.industrygroup.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardIndustryGroupController@EditSave')->name('setting.admin.dashboard.industrygroup.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardIndustryGroupController@Delete')->name('setting.admin.dashboard.industrygroup.delete'); 
                });
                Route::group(['prefix' => 'registeredcapitaltype'], function(){
                    Route::get('','SettingAdminDashboardRegisteredCapitalTypeController@Index')->name('setting.admin.dashboard.registeredcapitaltype');           
                    Route::get('create','SettingAdminDashboardRegisteredCapitalTypeController@Create')->name('setting.admin.dashboard.registeredcapitaltype.create'); 
                    Route::post('createsave','SettingAdminDashboardRegisteredCapitalTypeController@CreateSave')->name('setting.admin.dashboard.registeredcapitaltype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardRegisteredCapitalTypeController@Edit')->name('setting.admin.dashboard.registeredcapitaltype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardRegisteredCapitalTypeController@EditSave')->name('setting.admin.dashboard.registeredcapitaltype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardRegisteredCapitalTypeController@Delete')->name('setting.admin.dashboard.registeredcapitaltype.delete'); 
                });
                Route::group(['prefix' => 'businessplanstatus'], function(){
                    Route::get('','SettingAdminDashboardBusinessPlanStatusController@Index')->name('setting.admin.dashboard.businessplanstatus');           
                    Route::get('create','SettingAdminDashboardBusinessPlanStatusController@Create')->name('setting.admin.dashboard.businessplanstatus.create'); 
                    Route::post('createsave','SettingAdminDashboardBusinessPlanStatusController@CreateSave')->name('setting.admin.dashboard.businessplanstatus.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBusinessPlanStatusController@Edit')->name('setting.admin.dashboard.businessplanstatus.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBusinessPlanStatusController@EditSave')->name('setting.admin.dashboard.businessplanstatus.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBusinessPlanStatusController@Delete')->name('setting.admin.dashboard.businessplanstatus.delete'); 
                });
                Route::group(['prefix' => 'userposition'], function(){
                    Route::get('','SettingAdminDashboardUserPositionController@Index')->name('setting.admin.dashboard.userposition');           
                    Route::get('create','SettingAdminDashboardUserPositionController@Create')->name('setting.admin.dashboard.userposition.create'); 
                    Route::post('createsave','SettingAdminDashboardUserPositionController@CreateSave')->name('setting.admin.dashboard.userposition.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardUserPositionController@Edit')->name('setting.admin.dashboard.userposition.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardUserPositionController@EditSave')->name('setting.admin.dashboard.userposition.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardUserPositionController@Delete')->name('setting.admin.dashboard.userposition.delete'); 
                });
                Route::group(['prefix' => 'expertposition'], function(){
                    Route::get('','SettingAdminDashboardExpertPositionController@Index')->name('setting.admin.dashboard.expertposition');           
                    Route::get('create','SettingAdminDashboardExpertPositionController@Create')->name('setting.admin.dashboard.expertposition.create'); 
                    Route::post('createsave','SettingAdminDashboardExpertPositionController@CreateSave')->name('setting.admin.dashboard.expertposition.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardExpertPositionController@Edit')->name('setting.admin.dashboard.expertposition.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardExpertPositionController@EditSave')->name('setting.admin.dashboard.expertposition.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardExpertPositionController@Delete')->name('setting.admin.dashboard.expertposition.delete'); 
                });
                Route::group(['prefix' => 'pageimage'], function(){
                    Route::get('delete/{id}','SettingAdminDashboardPageImageController@Delete')->name('setting.admin.dashboard.pageimage.delete');           
                });
                Route::group(['prefix' => 'banktype'], function(){
                    Route::get('','SettingAdminDashboardBankTypeController@Index')->name('setting.admin.dashboard.banktype');           
                    Route::get('create','SettingAdminDashboardBankTypeController@Create')->name('setting.admin.dashboard.banktype.create'); 
                    Route::post('createsave','SettingAdminDashboardBankTypeController@CreateSave')->name('setting.admin.dashboard.banktype.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBankTypeController@Edit')->name('setting.admin.dashboard.banktype.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBankTypeController@EditSave')->name('setting.admin.dashboard.banktype.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBankTypeController@Delete')->name('setting.admin.dashboard.banktype.delete'); 
                });
                Route::group(['prefix' => 'bankaccount'], function(){
                    Route::get('','SettingAdminDashboardBankAccountController@Index')->name('setting.admin.dashboard.bankaccount');           
                    Route::get('create','SettingAdminDashboardBankAccountController@Create')->name('setting.admin.dashboard.bankaccount.create'); 
                    Route::post('createsave','SettingAdminDashboardBankAccountController@CreateSave')->name('setting.admin.dashboard.bankaccount.createsave'); 
                    Route::get('edit/{id}','SettingAdminDashboardBankAccountController@Edit')->name('setting.admin.dashboard.bankaccount.edit'); 
                    Route::post('editsave/{id}','SettingAdminDashboardBankAccountController@EditSave')->name('setting.admin.dashboard.bankaccount.editsave'); 
                    Route::get('delete/{id}','SettingAdminDashboardBankAccountController@Delete')->name('setting.admin.dashboard.bankaccount.delete'); 
                });
            }); 
            Route::group(['prefix' => 'website'], function(){
                Route::group(['prefix' => 'pagestatus'], function(){
                    Route::get('','SettingAdminWebsitePageStatusController@Index')->name('setting.admin.website.pagestatus');           
                    Route::get('create','SettingAdminWebsitePageStatusController@Create')->name('setting.admin.website.pagestatus.create'); 
                    Route::post('createsave','SettingAdminWebsitePageStatusController@CreateSave')->name('setting.admin.website.pagestatus.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsitePageStatusController@Edit')->name('setting.admin.website.pagestatus.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsitePageStatusController@EditSave')->name('setting.admin.website.pagestatus.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsitePageStatusController@Delete')->name('setting.admin.website.pagestatus.delete'); 
                });
                Route::group(['prefix' => 'pagecategory'], function(){
                    Route::get('create','SettingAdminWebsitePageCategoryController@Create')->name('setting.admin.website.pagecategory.create'); 
                    Route::post('crud','SettingAdminWebsitePageCategoryController@Crud')->name('setting.admin.website.pagecategory.crud');
                });
                Route::group(['prefix' => 'faqcategory'], function(){
                    Route::get('','SettingAdminWebsiteFaqCategoryController@Index')->name('setting.admin.website.faqcategory');           
                    Route::get('create','SettingAdminWebsiteFaqCategoryController@Create')->name('setting.admin.website.faqcategory.create'); 
                    Route::post('createsave','SettingAdminWebsiteFaqCategoryController@CreateSave')->name('setting.admin.website.faqcategory.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteFaqCategoryController@Edit')->name('setting.admin.website.faqcategory.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteFaqCategoryController@EditSave')->name('setting.admin.website.faqcategory.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteFaqCategoryController@Delete')->name('setting.admin.website.faqcategory.delete'); 
                });
                Route::group(['prefix' => 'tag'], function(){
                    Route::get('','SettingAdminWebsiteTagController@Index')->name('setting.admin.website.tag');           
                    Route::get('create','SettingAdminWebsiteTagController@Create')->name('setting.admin.website.tag.create'); 
                    Route::post('createsave','SettingAdminWebsiteTagController@CreateSave')->name('setting.admin.website.tag.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteTagController@Edit')->name('setting.admin.website.tag.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteTagController@EditSave')->name('setting.admin.website.tag.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteTagController@Delete')->name('setting.admin.website.tag.delete'); 
                });
    
                Route::group(['prefix' => 'slide'], function(){
                    Route::get('','SettingAdminWebsiteSlideController@Index')->name('setting.admin.website.slide');           
                    Route::get('create','SettingAdminWebsiteSlideController@Create')->name('setting.admin.website.slide.create'); 
                    Route::post('createsave','SettingAdminWebsiteSlideController@CreateSave')->name('setting.admin.website.slide.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteSlideController@Edit')->name('setting.admin.website.slide.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteSlideController@EditSave')->name('setting.admin.website.slide.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteSlideController@Delete')->name('setting.admin.website.slide.delete'); 
                });
                Route::group(['prefix' => 'introsection'], function(){
                    Route::get('','SettingAdminWebsiteIntroSectionController@Index')->name('setting.admin.website.introsection');           
                    Route::get('create','SettingAdminWebsiteIntroSectionController@Create')->name('setting.admin.website.introsection.create'); 
                    Route::post('createsave','SettingAdminWebsiteIntroSectionController@CreateSave')->name('setting.admin.website.introsection.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsiteIntroSectionController@Edit')->name('setting.admin.website.introsection.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsiteIntroSectionController@EditSave')->name('setting.admin.website.introsection.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsiteIntroSectionController@Delete')->name('setting.admin.website.introsection.delete'); 
                });
                Route::group(['prefix' => 'page'], function(){
                    Route::get('','SettingAdminWebsitePageController@Index')->name('setting.admin.website.page');           
                    Route::get('create','SettingAdminWebsitePageController@Create')->name('setting.admin.website.page.create'); 
                    Route::post('createsave','SettingAdminWebsitePageController@CreateSave')->name('setting.admin.website.page.createsave'); 
                    Route::get('edit/{id}','SettingAdminWebsitePageController@Edit')->name('setting.admin.website.page.edit'); 
                    Route::post('editsave/{id}','SettingAdminWebsitePageController@EditSave')->name('setting.admin.website.page.editsave'); 
                    Route::get('delete/{id}','SettingAdminWebsitePageController@Delete')->name('setting.admin.website.page.delete'); 
                });
                Route::group(['prefix' => 'menu'], function(){     
                    Route::get('create','SettingAdminWebsiteMenuController@Create')->name('setting.admin.website.menu.create'); 
                    Route::post('crud','SettingAdminWebsiteMenuController@Crud')->name('setting.admin.website.menu.crud');
                });
                Route::group(['prefix' => 'layout'], function(){     
                    Route::get('','SettingAdminWebsiteLayoutController@Index')->name('setting.admin.website.layout'); 
                });
                Route::group(['prefix' => 'frontpage'], function(){     
                    Route::get('','SettingAdminWebsiteFrontPageController@Index')->name('setting.admin.website.frontpage'); 
                    Route::post('save','SettingAdminWebsiteFrontPageController@Save')->name('setting.admin.website.frontpage.save'); 
                });
            }); 
            Route::group(['prefix' => 'user'], function(){
                Route::get('','SettingAdminUserController@Index')->name('setting.admin.user');           
                Route::get('create','SettingAdminUserController@Create')->name('setting.admin.user.create'); 
                Route::post('createsave','SettingAdminUserController@CreateSave')->name('setting.admin.user.createsave'); 
                Route::get('edit/{id}','SettingAdminUserController@Edit')->name('setting.admin.user.edit'); 
                Route::post('editsave/{id}','SettingAdminUserController@EditSave')->name('setting.admin.user.editsave'); 
                Route::get('delete/{id}','SettingAdminUserController@Delete')->name('setting.admin.user.delete'); 
            });
            Route::group(['prefix' => 'assessment'], function(){
                Route::group(['prefix' => 'criteriagroup'], function(){
                    Route::get('','SettingAdminAssessmentCriteriaGroupController@Index')->name('setting.admin.assessment.criteriagroup');           
                    Route::get('create','SettingAdminAssessmentCriteriaGroupController@Create')->name('setting.admin.assessment.criteriagroup.create'); 
                    Route::post('createsave','SettingAdminAssessmentCriteriaGroupController@CreateSave')->name('setting.admin.assessment.criteriagroup.createsave'); 
                    Route::get('edit/{id}','SettingAdminAssessmentCriteriaGroupController@Edit')->name('setting.admin.assessment.criteriagroup.edit'); 
                    Route::post('editsave/{id}','SettingAdminAssessmentCriteriaGroupController@EditSave')->name('setting.admin.assessment.criteriagroup.editsave');
                    Route::get('editweight/{id}','SettingAdminAssessmentCriteriaGroupController@EditWeight')->name('setting.admin.assessment.criteriagroup.editweight');  
                    Route::post('editweightsave/{id}','SettingAdminAssessmentCriteriaGroupController@EditWeightSave')->name('setting.admin.assessment.criteriagroup.editweightsave');  
                    Route::get('delete/{id}','SettingAdminAssessmentCriteriaGroupController@Delete')->name('setting.admin.assessment.criteriagroup.delete'); 
                });
                Route::group(['prefix' => 'criteria'], function(){
                    Route::get('','SettingAdminAssessmentCriteriaController@Index')->name('setting.admin.assessment.criteria');           
                    Route::get('create','SettingAdminAssessmentCriteriaController@Create')->name('setting.admin.assessment.criteria.create');           
                    Route::post('createsave','SettingAdminAssessmentCriteriaController@CreateSave')->name('setting.admin.assessment.criteria.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentCriteriaController@Edit')->name('setting.admin.assessment.criteria.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentCriteriaController@EditSave')->name('setting.admin.assessment.criteria.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentCriteriaController@Delete')->name('setting.admin.assessment.criteria.delete');  
                });
                // Route::group(['prefix' => 'cluster'], function(){
                //     Route::get('','SettingAdminAssessmentClusterController@Index')->name('setting.admin.assessment.cluster');           
                //     Route::get('create','SettingAdminAssessmentClusterController@Create')->name('setting.admin.assessment.cluster.create');           
                //     Route::post('createsave','SettingAdminAssessmentClusterController@CreateSave')->name('setting.admin.assessment.cluster.createsave');           
                //     Route::get('edit/{id}','SettingAdminAssessmentClusterController@Edit')->name('setting.admin.assessment.cluster.edit');           
                //     Route::post('editsave/{id}','SettingAdminAssessmentClusterController@EditSave')->name('setting.admin.assessment.cluster.editsave'); 
                //     Route::get('editcluster/{id}','SettingAdminAssessmentClusterController@EditCluster')->name('setting.admin.assessment.cluster.editcluster');           
                //     Route::get('delete/{id}','SettingAdminAssessmentClusterController@Delete')->name('setting.admin.assessment.cluster.delete');  
                // });
                Route::group(['prefix' => 'evportion'], function(){
                    Route::get('','SettingAdminAssessmentEvPortionController@Index')->name('setting.admin.assessment.evportion');           
                    Route::get('edit/{id}','SettingAdminAssessmentEvPortionController@Edit')->name('setting.admin.assessment.evportion.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentEvPortionController@EditSave')->name('setting.admin.assessment.evportion.editsave'); 
                    Route::get('editev/{id}','SettingAdminAssessmentEvPortionController@EditEv')->name('setting.admin.assessment.evportion.editev');           
                    Route::get('delete/{id}','SettingAdminAssessmentEvPortionController@Delete')->name('setting.admin.assessment.evportion.delete');  
                });
                Route::group(['prefix' => 'ev'], function(){
                    Route::get('','SettingAdminAssessmentEvController@Index')->name('setting.admin.assessment.ev');           
                    Route::get('create','SettingAdminAssessmentEvController@Create')->name('setting.admin.assessment.ev.create');           
                    Route::post('createsave','SettingAdminAssessmentEvController@CreateSave')->name('setting.admin.assessment.ev.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentEvController@Edit')->name('setting.admin.assessment.ev.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentEvController@EditSave')->name('setting.admin.assessment.ev.editsave'); 
                    Route::get('editev/{id}','SettingAdminAssessmentEvController@EditEv')->name('setting.admin.assessment.ev.editev');           
                    Route::get('delete/{id}','SettingAdminAssessmentEvController@Delete')->name('setting.admin.assessment.ev.delete');  
                });
                Route::group(['prefix' => 'pillar'], function(){
                    Route::get('','SettingAdminAssessmentPillarController@Index')->name('setting.admin.assessment.pillar'); 
                    Route::get('create','SettingAdminAssessmentPillarController@Create')->name('setting.admin.assessment.pillar.create');           
                    Route::post('createsave','SettingAdminAssessmentPillarController@CreateSave')->name('setting.admin.assessment.pillar.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentPillarController@Edit')->name('setting.admin.assessment.pillar.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentPillarController@EditSave')->name('setting.admin.assessment.pillar.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentPillarController@Delete')->name('setting.admin.assessment.pillar.delete');            
                });
                Route::group(['prefix' => 'subpillar'], function(){
                    Route::get('','SettingAdminAssessmentSubPillarController@Index')->name('setting.admin.assessment.subpillar'); 
                    Route::get('create','SettingAdminAssessmentSubPillarController@Create')->name('setting.admin.assessment.subpillar.create');           
                    Route::post('createsave','SettingAdminAssessmentSubPillarController@CreateSave')->name('setting.admin.assessment.subpillar.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentSubPillarController@Edit')->name('setting.admin.assessment.subpillar.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentSubPillarController@EditSave')->name('setting.admin.assessment.subpillar.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentSubPillarController@Delete')->name('setting.admin.assessment.subpillar.delete');            
                });
                Route::group(['prefix' => 'subpillarindex'], function(){
                    Route::get('','SettingAdminAssessmentSubPillarIndexController@Index')->name('setting.admin.assessment.subpillarindex'); 
                    Route::get('create','SettingAdminAssessmentSubPillarIndexController@Create')->name('setting.admin.assessment.subpillarindex.create');           
                    Route::post('createsave','SettingAdminAssessmentSubPillarIndexController@CreateSave')->name('setting.admin.assessment.subpillarindex.createsave');           
                    Route::get('edit/{id}','SettingAdminAssessmentSubPillarIndexController@Edit')->name('setting.admin.assessment.subpillarindex.edit');           
                    Route::post('editsave/{id}','SettingAdminAssessmentSubPillarIndexController@EditSave')->name('setting.admin.assessment.subpillarindex.editsave'); 
                    Route::get('delete/{id}','SettingAdminAssessmentSubPillarIndexController@Delete')->name('setting.admin.assessment.subpillarindex.delete');            
                    Route::post('getsubpillar','SettingAdminAssessmentSubPillarIndexController@GetSubPillar')->name('setting.admin.assessment.subpillarindex.getsubpillar');            
                });
            });
        });
        Route::group(['prefix' => 'expert'], function(){

        });
        Route::group(['prefix' => 'user'], function(){
            Route::group(['prefix' => 'company'], function(){
                Route::get('edit/{userid}','SettingUserCompanyController@Edit')->name('setting.user.company.edit');           
                Route::post('editsave/{id}','SettingUserCompanyController@EditSave')->name('setting.user.company.editsave'); 
            });
            // Route::group(['prefix' => 'businessplan'], function(){
            //     Route::get('edit/{userid}','SettingUserBusinessPlanController@Edit')->name('setting.user.businessplan.edit');           
            //     Route::post('editsave/{id}','SettingUserBusinessPlanController@EditSave')->name('setting.user.businessplan.editsave'); 
            // });
        });
        Route::group(['prefix' => 'profile'], function(){
            Route::get('edit/{userid}','SettingProfileController@Edit')->name('setting.profile.edit'); 
            Route::post('editsave/{userid}','SettingProfileController@EditSave')->name('setting.profile.editsave'); 
        });
    });   
});  

Route::group(['prefix' => 'line'], function(){
    Route::get('','LineSubScribeController@Index')->name('line');        
    Route::get('linesubscribe/{id}', 'LineSubScribeController@LineSubcribe')->name('line.subcribe');
    Route::get('linecallback', 'LineSubScribeController@LineCallback')->name('line.callback');
    Route::get('linesend', 'LineSubScribeController@LineSend')->name('line.send');           
}); 


