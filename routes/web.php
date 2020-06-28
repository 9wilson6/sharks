<?php
use App\Promotions;
use Illuminate\Support\Facades\Mail;

// FRONT PAGES
Route::get('/', 'Pages@index');
Route::get('/tos', 'Pages@tos');
Route::get('/privacy-policy', 'Pages@privacy_policy');
Route::get('/revision-policy', 'Pages@revision_policy');

Route::get('/plagiarism-free-guarantee', 'Pages@plagiarism_free_guarantee');
Route::get('/refund-policy', 'Pages@refund_policy');
Route::get('/contact', 'Pages@contact');

//Register tutor
Route::get('/become-a-tutor', 'Pages@becomeatutor');
Route::post('/registertutor', 'Auth\RegisterController@register_tutor');

//Resister student
Route::post('/save-student', 'SignupUser@storestudent');

//Route::get('/postproject', ['as' => 'projects.post', 'middleware' => 'auth', 'uses' => 'PostOrderController@postproject']);

Route::post('/save-project', ['as' => 'projects.post.save', 'uses' => 'PostOrderController@save_project']);

Route::post('/save-project-order', ['as' => 'projects.post.order', 'uses' => 'PostOrderController@save_project_order']);



Route::get('/send/one/test', 'PromotionsController@testemail');


Route::get('/amount/you/get/{amount}', 'TutorController@amountyouget');

//Add login as
Route::post('loginas', ['as' => 'admin.loginas', 'uses' => 'AdminController@loginas']);

// Company

Route::group(['prefix' => 'pages'], function () {
    Route::post('/store', ['as' => 'pages.store', 'uses' => 'PagesController@store']);
    Route::get('/array', ['as' => 'pages.array', 'uses' => 'PagesController@array']);
});

Route::group(['prefix' => 'reviews'], function () {
    Route::get('/get/latest', ['as' => 'reviews.get.latest', 'uses' => 'ReviewsController@getlatest']);
});


Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


// FRONT PAGES
Route::get('/welcome', ['as' => 'welcome', 'middleware' => 'auth', 'uses' => 'AdminController@redirectrole']);

//Register tutor
// Route::get('/become-a-tutor', 'Pages@becomeatutor');
Route::post('/registertutor', 'Auth\RegisterController@register_tutor');

//Resister student
Route::post('/save-student', 'SignupUser@storestudent');

//Post projects
Route::group(['prefix' => 'projects'], function () {
    Route::get('/post', ['as' => 'projects.post', 'middleware' => 'auth', 'uses' => 'PostOrderController@postproject']);
    Route::get('/islogged/in', ['as' => 'projects.user.loggedin', 'uses' => 'PostOrderController@loggedin']);
    Route::post('/isuser/registered', ['as' => 'projects.user.isuseregistered', 'uses' => 'PostOrderController@isuseregistered']);
    Route::post('/save/loggedin', ['as' => 'projects.post.save.loggedin', 'uses' => 'PostOrderController@saveloggedin']);
    Route::post('/save', ['as' => 'projects.post.save', 'uses' => 'PostOrderController@save']);
    Route::post('/login', ['as' => 'projects.post.login', 'uses' => 'PostOrderController@postlogin']);
    Route::post('/save-project', ['as' => 'projects.post.order', 'uses' => 'PostOrderController@save_project_order']);
});


//Student Routes
Route::group(['prefix' => 'home', 'middleware' => ['role:student', 'auth']], function () {
    Route::get('/', ['as' => 'studenthome', 'uses' => 'StudentController@index']);

    Route::post('/extend/deadline/{id}', ['as' => 'home.extend.deadline', 'uses' => 'StudentOrdersController@extend']);

    //Student account
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'student.profile', 'uses' => 'StudentController@profile']);
        Route::get('/scholars-online', ['as' => 'scholars.online', 'uses' => 'StudentController@scholaronline']);
        Route::get('/change-password', ['as' => 'student.changepass', 'uses' => 'StudentController@changepass']);
        Route::get('/edit', ['as' => 'student.edit', 'uses' => 'StudentController@edit']);
        Route::post('/update-profile', ['as' => 'student.updateprofile', 'uses' => 'StudentController@updateprofile']);
        Route::post('/updatepassword', ['as' => 'student.updatepassword', 'uses' => 'StudentController@updatepassword']);
        Route::get('/scholar-profile/{id}', ['as' => 'student.scholarprofile', 'uses' => 'StudentController@scholarprofile']);
    });
    //Orders
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'home.orders', 'uses' => 'StudentOrdersController@index']);
        Route::get('{id}', ['as' => 'home.order', 'uses' => 'StudentOrdersController@order']);
        Route::get('/edit/{id}', ['as' => 'home.order.edit', 'uses' => 'StudentOrdersController@edit']);
        Route::get('/delete/{id}', ['as' => 'home.order.delete', 'uses' => 'StudentOrdersController@deleteorder']);
        Route::post('/update/{id}', ['as' => 'home.order.update', 'uses' => 'StudentOrdersController@update']);
        Route::get('/dispute/{id}', ['as' => 'home.dispute.order', 'uses' => 'StudentOrdersController@dispute_order']);
        Route::get('/withdraw-dispute/{id}', ['as' => 'home.dispute.withdraw', 'uses' => 'StudentOrdersController@dispute_withdraw']);
        Route::post('/save-dispute/{id}', ['as' => 'home.dispute.save', 'uses' => 'StudentOrdersController@save_dispute']);
        //Rate tutor
        Route::get('/rate-tutor/{id}', ['as' => 'student.rate.tutor', 'uses' => 'StudentOrdersController@ratetutor']);
        Route::post('/rate-tutor-save/{id}', ['as' => 'student.rate.tutor.save', 'uses' => 'StudentOrdersController@save_tutor_ratings']);

        //Revision
        Route::get('/revision/{id}', ['as' => 'home.revision.order', 'uses' => 'StudentOrdersController@revision_order']);
        Route::get('/download-revision/{id}/{file_name}', ['as' => 'home.revision.download', 'uses' => 'StudentOrdersController@download_revision']);
        Route::post('/save-revision/{id}', ['as' => 'home.revision.save', 'uses' => 'StudentOrdersController@save_revision']);
    });
    //Student payments
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', ['as' => 'student.payments', 'uses' => 'StudentPaymentsController@index']);
        Route::get('/pay/order/{bidid}', ['as' => 'student.pay.order', 'uses' => 'StudentPaymentsController@payorder']);
        Route::get('/add', ['as' => 'student.addfunds', 'uses' => 'StudentPaymentsController@addpayments']);
        Route::post('/paypal', ['as' => 'student.pay.paypal', 'uses' => 'StudentPaymentsController@payViaPaypal']);
        Route::get('/paypal/verify', ['as' => 'paypal.verify', 'uses' => 'StudentPaymentsController@getPaymentStatus']);
        //Release payments
        Route::get('/release/{id}', ['as' => 'student.payments.release', 'uses' => 'StudentPaymentsController@release_payment']);
    });
    //Upload order files
    Route::group(['prefix' => 'orderuploads'], function () {
        Route::get('/upload/{id}', ['as' => 'upload.order', 'uses' => 'OrderUploadsController@upload']);
        Route::get('/get/{id}/{filename}', ['as' => 'upload.order', 'uses' => 'OrderUploadsController@download']);
        Route::post('/save/{id}', ['as' => 'upload.save.order', 'uses' => 'OrderUploadsController@saveupload']);
        Route::get('/get/solution/{id}/{filename}', ['as' => 'student.solution.download', 'uses' => 'OrderUploadsController@download_solution']);
    });


    //Ratings only added by the student
    Route::group(['prefix' => 'ratings'], function () {
        Route::get('/rate/{id}', ['as' => 'rate.order', 'uses' => 'RatingsController@rateorder']);
        Route::post('/rate', ['as' => 'rate.save', 'uses' => 'RatingsController@saverate']);
    });

    //Student bidding
    Route::group(['prefix' => 'bids'], function () {
        Route::get('/{id}', ['as' => 'student.bids', 'uses' => 'StudentBidsController@index']);
    });

    //Favorite scholars
    Route::group(['prefix' => 'favorite-scholars'], function () {
        Route::get('/', ['as' => 'favorite.scholars', 'uses' => 'FavoriteScholarController@index']);
        Route::get('/add/{tutor}', ['as' => 'favorite.scholars.add', 'uses' => 'FavoriteScholarController@add']);
    });

    //Student view order details
    Route::group(['prefix' => 'order-details'], function () {
        Route::get('/{order_id}', ['as' => 'student.order.details', 'uses' => 'StudentOrdersController@order']);
    });

    //Student messages route
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'student.messages', 'uses' => 'StudentMessagesController@index']);
        Route::get('/create/{id}', ['as' => 'student.messages.create', 'uses' => 'StudentMessagesController@create']);
        Route::post('/store/{id}', ['as' => 'student.messages.store', 'uses' => 'StudentMessagesController@store']);
        Route::post('/supportstore', ['as' => 'student.messages.supportstore', 'uses' => 'StudentMessagesController@supportstore']);
        Route::get('/show/{id}', ['as' => 'student.messages.show', 'uses' => 'StudentMessagesController@show']);
        Route::put('/update/{id}', ['as' => 'student.messages.update', 'uses' => 'StudentMessagesController@update']);
        Route::get('download/{threadid}/{messageid}/{filename}', ['as' => 'student.messages.download', 'uses' => 'StudentMessagesController@download_message_upload']);
    });

});

//Tutor Routes
Route::group(['prefix' => 'account', 'middleware' => ['role:tutor', 'auth']], function () {
    Route::get('/', ['as' => 'tutorhome', 'uses' => 'TutorController@index']);
    //tutor account
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', ['as' => 'tutor.profile', 'uses' => 'TutorController@profile']);
        Route::get('/editprofile', ['as' => 'tutor.edit', 'uses' => 'TutorController@editprofile']);
        Route::post('/upload', ['as' => 'tutor.attachments', 'uses' => 'UserAttachmentsController@upload']);
        Route::get('/delete-upload/{id}', ['as' => 'tutor.attachments.delete', 'uses' => 'UserAttachmentsController@delete']);
        Route::get('/download/{id}', ['as' => 'tutor.attachments.download', 'uses' => 'UserAttachmentsController@download']);
        Route::post('/edit-account', ['as' => 'tutor.save', 'uses' => 'TutorController@edit']);
        Route::get('/change-password', ['as' => 'tutor.changepass', 'uses' => 'TutorController@changepass']);
        Route::post('/updatepassword', ['as' => 'tutor.updatepassword', 'uses' => 'TutorController@updatepassword']);
        Route::get('/scholar-profile', ['as' => 'tutor.scholarprofile', 'uses' => 'TutorController@scholarprofile']);
        Route::get('/scholarhelp', ['as' => 'tutor.scholarhelp', 'uses' => 'TutorController@scholarhelp']);
        Route::get('/student-profile/{id}', ['as' => 'tutor.studentprofile', 'uses' => 'TutorController@student_profile']);
    });

    //Tutor bidding
    Route::group(['prefix' => 'bids'], function () {
        Route::get('/', ['as' => 'tutor.bids', 'uses' => 'TutorBidsController@index']);
        Route::get('/delete/{id}', ['as' => 'bids.delete', 'uses' => 'TutorBidsController@delete']);
        Route::get('/{id}', ['as' => 'tutor.bids.order', 'uses' => 'TutorBidsController@tutorbids']);
        Route::post('/add/{orderid}', ['as' => 'tutor.bids.add', 'uses' => 'TutorBidsController@add']);
    });

    //Tutor payments
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', ['as' => 'tutor.payments', 'uses' => 'TutorPaymentsController@index']);
        Route::get('/refund/{id}', ['as' => 'tutor.order.refund', 'uses' => 'TutorOrdersController@refundorder']);
    });

    //Orders
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'tutor.orders', 'uses' => 'TutorOrdersController@index']);
        Route::get('/find', ['as' => 'tutor.orders.find', 'uses' => 'TutorOrdersController@find']);
        Route::get('{id}', ['as' => 'tutor.order', 'uses' => 'TutorOrdersController@order']);
        Route::get('/edit/{id}', ['as' => 'tutor.order.edit', 'uses' => 'TutorOrdersController@edit']);
        Route::post('/update/{id}', ['as' => 'tutor.order.update', 'uses' => 'TutorOrdersController@update']);

        Route::get('/download-revision/{id}/{file_name}', ['as' => 'tutor.revision.download', 'uses' => 'TutorOrdersController@download_revision']);

        //Rate tutor
        Route::get('/rate-student/{id}', ['as' => 'tutor.rate.student', 'uses' => 'TutorOrdersController@ratestudent']);
        Route::post('/rate-student-save/{id}', ['as' => 'tutor.rate.student.save', 'uses' => 'TutorOrdersController@save_student_ratings']);
    });
    //Upload order files
    Route::group(['prefix' => 'orderuploads'], function () {
        Route::get('/get/{id}/{filename}', ['as' => 'tutor.download.order', 'uses' => 'TutorOrdersController@download']);
    });

    //Upload solution for tutor
    Route::group(['prefix' => 'solution'], function () {
        Route::get('/add/{id}', ['as' => 'tutor.solution.add', 'uses' => 'TutorOrdersController@add_solution']);
        Route::get('/get/{id}/{filename}', ['as' => 'tutor.solution.download', 'uses' => 'TutorOrdersController@download_solution']);
        Route::post('/save/{id}', ['as' => 'tutor.solution.add', 'uses' => 'TutorOrdersController@save_solution']);
    });

    //Student messages route
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'tutor.messages', 'uses' => 'TutorMessagesController@index']);
        Route::get('/create/{id}', ['as' => 'tutor.messages.create', 'uses' => 'TutorMessagesController@create']);
        Route::post('/store/{id}', ['as' => 'tutor.messages.store', 'uses' => 'TutorMessagesController@store']);
        Route::post('/supportstore', ['as' => 'tutor.messages.supportstore', 'uses' => 'TutorMessagesController@supportstore']);
        Route::get('/show/{id}', ['as' => 'tutor.messages.show', 'uses' => 'TutorMessagesController@show']);
        Route::put('/update/{id}', ['as' => 'tutor.messages.update', 'uses' => 'TutorMessagesController@update']);
        Route::get('download/{threadid}/{messageid}/{filename}', ['as' => 'tutor.messages.download', 'uses' => 'TutorMessagesController@download_message_upload']);
    });

    Route::group(['prefix' => 'manual-releases'], function () {
        Route::get('/request/{id}', ['as' => 'tutor.manualreleases.request', 'uses' => 'ManualReleaseController@request_release']);
    });

    Route::group(['prefix' => 'refunds'], function () {
        Route::get('/', ['as' => 'tutor.refunds', 'uses' => 'RefundController@tutorefunds']);
    });

});

//Post orders
Route::group(['prefix' => 'post-order'], function () {
    Route::post('/', ['uses' => 'PostOrderController@index']);
    Route::post('/checkifexists', ['uses' => 'PostOrderController@checkifexists']);
    Route::post('/login', ['uses' => 'PostOrderController@login']);
    Route::post('/register', ['uses' => 'PostOrderController@register']);
});


//Message admin and super admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|superadmin', 'auth']], function () {

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/change-password', ['as' => 'admin.changepass', 'uses' => 'AdminController@changepass']);
        Route::post('/updatepassword', ['as' => 'admin.updatepassword', 'uses' => 'AdminController@updatepassword']);
    });
    //Clients routes
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', ['as' => 'admin.clients', 'uses' => 'ClientsController@index']);
        Route::get('/get', ['as' => 'admin.clients.get', 'uses' => 'AdminController@getstudents']);
        Route::get('/create', ['as' => 'admin.clients.create', 'uses' => 'ClientsController@create']);
        Route::get('/download_sample', ['as' => 'admin.clients.sample', 'uses' => 'ClientsController@download_sample']);
        Route::get('/import', ['as' => 'admin.clients.import', 'uses' => 'ClientsController@import']);
        Route::post('/store', ['as' => 'admin.clients.store', 'uses' => 'ClientsController@store']);
        Route::post('/store-import', ['as' => 'admin.clients.store.import', 'uses' => 'ClientsController@importsave']);
        Route::get('/edit/{id}', ['as' => 'admin.clients.edit', 'uses' => 'ClientsController@edit']);
        Route::get('/reset/{id}', ['as' => 'admin.clients.reset', 'uses' => 'ClientsController@reset']);
        Route::get('/suspend/{id}', ['as' => 'admin.clients.suspend', 'uses' => 'ClientsController@suspend']);
        Route::get('/unsuspend/{id}', ['as' => 'admin.clients.unsuspend', 'uses' => 'ClientsController@unsuspend']);
        Route::get('/show/{id}', ['as' => 'admin.clients.show', 'uses' => 'ClientsController@show']);
        Route::post('/update/{id}', ['as' => 'admin.clients.update', 'uses' => 'ClientsController@update']);
        Route::get('/destroy/{id}', ['as' => 'admin.clients.delete', 'uses' => 'ClientsController@destroy']);

        //Student profile
        Route::get('/student-profile/{id}', ['as' => 'admin.studentprofile', 'uses' => 'ClientsController@studentprofile']);
        //Student payments
        Route::get('/payments/{id}', ['as' => 'admin.clients.payments', 'uses' => 'ClientsController@payments']);
        //Withdraw funds
        Route::post('/withdraw/student/{id}', ['as' => 'admin.clients.withdraw', 'uses' => 'ClientsController@withdraw']);
        //Orders
        Route::get('/orders/{id}', ['as' => 'admin.clients.orders', 'uses' => 'ClientsController@orders']);
    });
    //Tutors routes
    Route::group(['prefix' => 'tutors'], function () {
        Route::get('/', ['as' => 'admin.tutors', 'uses' => 'TutorsController@index']);
        Route::get('/get', ['as' => 'admin.tutors.get', 'uses' => 'AdminController@gettutors']);
        Route::get('/create', ['as' => 'admin.tutors.create', 'uses' => 'TutorsController@create']);
        Route::post('/store', ['as' => 'admin.tutors.store', 'uses' => 'TutorsController@store']);
        Route::get('/edit/{id}', ['as' => 'admin.tutors.edit', 'uses' => 'TutorsController@edit']);
        Route::get('/reset/{id}', ['as' => 'admin.tutors.reset', 'uses' => 'TutorsController@reset']);
        Route::get('/verify/{id}', ['as' => 'admin.tutors.verify', 'uses' => 'TutorsController@verify']);
        Route::get('/unverify/{id}', ['as' => 'admin.tutors.unverify', 'uses' => 'TutorsController@unverify']);

        Route::get('/suspend/{id}', ['as' => 'admin.tutors.suspend', 'uses' => 'TutorsController@suspend']);
        Route::get('/unsuspend/{id}', ['as' => 'admin.tutors.unsuspend', 'uses' => 'TutorsController@unsuspend']);


        Route::post('/update/{id}', ['as' => 'admin.tutors.update', 'uses' => 'TutorsController@update']);
        Route::get('/destroy/{id}', ['as' => 'admin.tutors.delete', 'uses' => 'TutorsController@destroy']);
        Route::get('/download/{id}/{user}', ['as' => 'admin.tutors.download', 'uses' => 'TutorsController@download']);
        Route::get('/scholar-profile/{id}', ['as' => 'admin.scholarprofile', 'uses' => 'TutorsController@scholarprofile']);
        //Tutor payments
        Route::get('/scholar-payments/{id}', ['as' => 'admin.tutors.payments', 'uses' => 'TutorsController@payments']);
        //Withdraw funds
        Route::post('/withdraw/tutor/{tutorid}', ['as' => 'admin.tutors.withdraw', 'uses' => 'TutorsController@withdraw']);
        //Orders
        Route::get('/awarded/{id}', ['as' => 'admin.tutors.awarded', 'uses' => 'TutorsController@awarded']);
        Route::get('/disputed/{id}', ['as' => 'admin.tutors.disputed', 'uses' => 'TutorsController@disputed']);
    });
    //Admin messages route
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'admin.messages', 'uses' => 'AdminMessagesController@index']);
        Route::get('/all', ['as' => 'admin.messages.all', 'uses' => 'AdminMessagesController@all']);
        Route::get('/create/{id}', ['as' => 'admin.messages.create', 'uses' => 'AdminMessagesController@create']);
        Route::get('/create/group/{id}', ['as' => 'admin.messages.create.group', 'uses' => 'AdminMessagesController@sendmessageto']);
        Route::post('/store/{id}', ['as' => 'admin.messages.store', 'uses' => 'AdminMessagesController@store']);
        Route::post('/store/group/{id}', ['as' => 'admin.messages.store.group', 'uses' => 'AdminMessagesController@storegroup']);
        Route::get('/show/{id}', ['as' => 'admin.messages.show', 'uses' => 'AdminMessagesController@show']);
        Route::put('/update/{id}', ['as' => 'admin.messages.update', 'uses' => 'AdminMessagesController@update']);
        Route::get('download/{threadid}/{messageid}/{filename}', ['as' => 'admin.messages.download', 'uses' => 'AdminMessagesController@download_message_upload']);
    });

    //Orders
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'admin.orders', 'uses' => 'AdminController@index']);
        Route::get('/get', ['as' => 'admin.orders.get', 'uses' => 'AdminController@getorders']);
        Route::get('/{id}', ['as' => 'admin.order', 'uses' => 'AdminController@order']);
        Route::get('/edit/{id}', ['as' => 'admin.order.edit', 'uses' => 'AdminController@edit']);
        Route::post('/update/{id}', ['as' => 'admin.order.update', 'uses' => 'AdminController@update']);
        Route::get('/delete/{id}', ['as' => 'admin.order.delete', 'uses' => 'AdminController@deleteorder']);
    });

    //Upload order files
    Route::group(['prefix' => 'orderuploads'], function () {
        Route::get('/upload/{id}', ['as' => 'admin.upload.order', 'uses' => 'OrderUploadsController@adminupload']);
        Route::get('/get/{id}/{filename}', ['as' => 'admin.upload.order', 'uses' => 'OrderUploadsController@download']);
        Route::post('/save/{id}', ['as' => 'admin.upload.save.order', 'uses' => 'OrderUploadsController@adminsaveupload']);
        Route::get('/get/solution/{id}/{filename}', ['as' => 'admin.solution.download', 'uses' => 'OrderUploadsController@download_solution']);
    });

    //Show bids
    Route::group(['prefix' => 'bids'], function () {
        Route::get('/all', ['as' => 'admin.bids', 'uses' => 'AdminController@allbids']);
        Route::get('{orderid}', ['as' => 'admin.bids.order', 'uses' => 'AdminController@bids']);
        Route::get('/tutor/{tutorid}', ['as' => 'admin.bids.tutor', 'uses' => 'AdminController@tutorbids']);
        Route::get('/delete/{id}', ['as' => 'admin.bids.delete', 'uses' => 'AdminController@delete_bid']);
        Route::get('/api/{id}', ['as' => 'admin.bids.order.api', 'uses' => 'AdminController@adminbids']);
    });

    //Show bids
    Route::group(['prefix' => 'disputes'], function () {
        Route::get('/', ['as' => 'admin.disputes', 'uses' => 'DisputesController@index']);
        Route::get('/withdraw/{id}', ['as' => 'admin.dispute.withdraw', 'uses' => 'DisputesController@withdraw']);
        Route::get('/refund/{id}', ['as' => 'admin.dispute.refund', 'uses' => 'DisputesController@refund']);
    });

    Route::group(['prefix' => 'refunds'], function () {
        Route::get('/', ['as' => 'admin.refunds', 'uses' => 'RefundController@index']);
        Route::get('/withdraw/{id}', ['as' => 'admin.refunds.withdraw', 'uses' => 'RefundController@withdraw']);
        Route::get('/refund/{id}', ['as' => 'admin.refunds.refund', 'uses' => 'RefundController@refund']);
    });

    Route::group(['prefix' => 'manual-releases'], function () {
        Route::get('/', ['as' => 'admin.manualreleases', 'uses' => 'ManualReleaseController@index']);
        Route::get('/approve/{id}', ['as' => 'admin.manualreleases.approve', 'uses' => 'ManualReleaseController@approve_request']);
    });

    Route::group(['prefix' => 'ratings'], function () {
        Route::post('/edit/{id}', ['as' => 'admin.ratings.edit', 'uses' => 'ReviewsController@edit']); 
    });
});

//Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|superadmin', 'auth']], function () {
    Route::group(['prefix' => 'balance', 'middleware' => ['role:admin|superadmin', 'auth']], function () {
        Route::get('/tutor/get/{id}', ['as' => 'admin.balance.tutor.get', 'uses' => 'BalanceController@tutorbalanceget']);    
    });
});

//Super Routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|superadmin', 'auth']], function () {
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    Route::group(['prefix' => 'settings', 'middleware' => ['role:superadmin', 'auth']], function () {
        Route::get('/', ['as' => 'admin.settings', 'uses' => 'SettingController@index']);
        Route::post('/updatemain', ['as' => 'admin.settings.updatemain', 'uses' => 'SettingController@updatemain']);
        Route::post('/updatetelegram', ['as' => 'admin.settings.updatetelegram', 'uses' => 'SettingController@updatetelegram']);
        Route::post('/updatebidding', ['as' => 'admin.settings.updatebidding', 'uses' => 'SettingController@updatebidding']);
        Route::post('/updatecommissions', ['as' => 'admin.settings.updatecommissions', 'uses' => 'SettingController@updatecommissions']);
    });    
});

//Route::get('/home', 'Account@index')->name('home');
//CREATE STUDENT AND TUTOR ACCOUNTS
Route::get('/check-escallation', 'RefundController@checkescallation');


Route::get('/my-clearall', ['as' => 'admin.clear.data', 'middleware' => ['role:admin|superadmin', 'auth'], 'uses' => 'AdminController@clearall']);

Route::get('/edit-pusher', ['as' => 'admin.editpusher', 'middleware' => ['role:admin|superadmin', 'auth'], 'uses' => 'AdminController@editpusher']);

Route::get('/pusher', ['as' => 'admin.pusher', 'middleware' => ['role:admin|superadmin', 'auth'], 'uses' => 'AdminController@pusher']);

Route::post('/edit-save', ['as' => 'admin.savepusher', 'middleware' => ['role:admin|superadmin', 'auth'], 'uses' => 'AdminController@savepusher']);
