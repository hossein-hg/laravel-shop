<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\SalesProcess\CartController;
use App\Http\Controllers\Customer\SalesProcess\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\Profile\FavoriteController;
use App\Http\Controllers\Customer\Profile\TicketController as ProfileTicketController;
use App\Http\Controllers\Customer\Profile\AddressController as ProfileAddressController;
use App\Http\Controllers\Customer\SalesProcess\ProfileCompletionController;
use App\Http\Controllers\Customer\Profile\OrderController as ProfileOrderController;
use App\Http\Controllers\Customer\Profile\ProfileController;
use App\Http\Controllers\Customer\Profile\CompareController;
use App\Http\Controllers\Customer\SalesProcess\AddressController;
use App\Http\Controllers\Customer\Market\ProductController as CustomerProductController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Content\FAQController ;
use App\Http\Controllers\Admin\Content\BannerController ;
use App\Http\Controllers\Admin\NotificationController ;
use App\Http\Controllers\Admin\Content\MenuController ;
use App\Http\Controllers\Admin\Content\PageController ;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\ProductGuaranteeController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Setting\SettingController;
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

// Admin

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminDashboardController::class,'index'])->name('admin.home');

    // market
    Route::prefix('market')->group(function (){

        // category
        Route::prefix('category')->group(function (){

            Route::get('/',[CategoryController::class,'index'])->name('admin.market.category.index');
            Route::get('/create',[CategoryController::class,'create'])->name('admin.market.category.create');
            Route::post('/store',[CategoryController::class,'store'])->name('admin.market.category.store');
            Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('admin.market.category.edit');
            Route::put('/update/{category}',[CategoryController::class,'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{category}',[CategoryController::class,'destroy'])->name('admin.market.category.destroy');
            Route::get('/status/{category}',[CategoryController::class,'status'])->name('admin.market.category.status');
            Route::get('/showInMenu/{category}',[CategoryController::class,'showInMenu'])->name('admin.market.category.showInMenu');

        });


        // brand
        Route::prefix('brand')->group(function (){

            Route::get('/',[BrandController::class,'index'])->name('admin.market.brand.index');
            Route::get('/create',[BrandController::class,'create'])->name('admin.market.brand.create');
            Route::post('/store',[BrandController::class,'store'])->name('admin.market.brand.store');
            Route::get('/edit/{brand}',[BrandController::class,'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{brand}',[BrandController::class,'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}',[BrandController::class,'destroy'])->name('admin.market.brand.destroy');
            Route::get('/status/{brand}',[BrandController::class,'status'])->name('admin.market.brand.status');



        });

        // comment
        Route::prefix('comment')->group(function (){

            Route::get('/',[CommentController::class,'index'])->name('admin.market.comment.index');
            Route::get('/show/{comment}',[CommentController::class,'show'])->name('admin.market.comment.show');
            Route::post('/store',[CommentController::class,'store'])->name('admin.market.comment.store');
            Route::get('/edit/{comment}',[CommentController::class,'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{comment}',[CommentController::class,'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{comment}',[CommentController::class,'destroy'])->name('admin.market.comment.destroy');
            Route::post('/answer/{comment}',[CommentController::class,'answer'])->name('admin.market.comment.answer');
            Route::get('/approve/{comment}',[CommentController::class,'approve'])->name('admin.market.comment.approve');



        });

        // delivery
        Route::prefix('delivery')->group(function (){

            Route::get('/',[DeliveryController::class,'index'])->name('admin.market.delivery.index');
            Route::get('/create',[DeliveryController::class,'create'])->name('admin.market.delivery.create');
            Route::post('/store',[DeliveryController::class,'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{delivery}',[DeliveryController::class,'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}',[DeliveryController::class,'update'])->name('admin.market.delivery.update');

            Route::get('/status/{delivery}',[DeliveryController::class,'status'])->name('admin.market.delivery.status');
            Route::delete('/destroy/{delivery}',[DeliveryController::class,'destroy'])->name('admin.market.delivery.destroy');
            Route::delete('/destroy/{delivery}',[DeliveryController::class,'destroy'])->name('admin.market.delivery.destroy');


        });

        // discount
        Route::prefix('discount')->group(function (){

            // index create
            Route::get('/coupon',[DiscountController::class,'coupon'])->name('admin.market.discount.coupon');
            Route::get('/coupon/create',[DiscountController::class,'couponCreate'])->name('admin.market.discount.coupon.create');
            Route::get('/common-discount',[DiscountController::class,'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create',[DiscountController::class,'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
            Route::get('/amazing-sale',[DiscountController::class,'amazingSale'])->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create',[DiscountController::class,'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');

            Route::post('/couponStore',[DiscountController::class,'couponStore'])->name('admin.market.discount.couponStore');
            Route::get('/couponEdit/{coupon}',[DiscountController::class,'editCoupon'])->name('admin.market.discount.editCoupon');
            Route::put('/couponUpdate/{coupon}',[DiscountController::class,'couponUpdate'])->name('admin.market.discount.couponUpdate');

            Route::post('/amazingStore',[DiscountController::class,'amazingStore'])->name('admin.market.discount.amazingStore');
            Route::get('/amazingEdit/{amazingSale}',[DiscountController::class,'editAmazing'])->name('admin.market.discount.editAmazing');
            Route::put('/amazingUpdate/{amazingSale}',[DiscountController::class,'amazingUpdate'])->name('admin.market.discount.amazingUpdate');

            Route::post('/commonStore',[DiscountController::class,'commonStore'])->name('admin.market.discount.commonStore');
            Route::get('/commonEdit/{commonDiscount}',[DiscountController::class,'editCommon'])->name('admin.market.discount.editCommon');
            Route::put('/commonUpdate/{commonDiscount}',[DiscountController::class,'commonUpdate'])->name('admin.market.discount.commonUpdate');




            Route::delete('/destroy/coupon/{coupon}',[DiscountController::class,'couponDestroy'])->name('admin.market.discount.couponDestroy');
            Route::delete('/destroy/common/{commonDiscount}',[DiscountController::class,'commonDiscountDestroy'])->name('admin.market.discount.commonDiscountDestroy');
            Route::delete('/destroy/amazing/{amazingSale}',[DiscountController::class,'amazingSaleDestroy'])->name('admin.market.discount.amazingSaleDestroy');


            Route::get('/couponStatus/{coupon}',[DiscountController::class,'couponStatus'])->name('admin.market.discount.couponStatus');
            Route::get('/commonDiscountStatus/{commonDiscount}',[DiscountController::class,'commonDiscountStatus'])->name('admin.market.discount.commonDiscountStatus');
            Route::get('/amazingSaleStatus/{amazingSale}',[DiscountController::class,'amazingSaleStatus'])->name('admin.market.discount.amazingSaleStatus');

        });


        // order
        Route::prefix('order')->group(function (){

            Route::get('/',[OrderController::class,'all'])->name('admin.market.order.all');
            Route::get('/new-order',[OrderController::class,'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/sending',[OrderController::class,'sending'])->name('admin.market.order.sending');
            Route::get('/unpaid',[OrderController::class,'unpaid'])->name('admin.market.order.unpaid');
            Route::get('/canceled',[OrderController::class,'canceled'])->name('admin.market.order.canceled');
            Route::get('/returned',[OrderController::class,'returned'])->name('admin.market.order.returned');
            Route::get('/show/{order}',[OrderController::class,'show'])->name('admin.market.order.show');
            Route::get('/show/{order}/detail',[OrderController::class,'detail'])->name('admin.market.order.detail');
            Route::get('/change-send-status/{order}',[OrderController::class,'changeSendStatus'])->name('admin.market.order.changeSendStatus');
            Route::get('/change-order-status/{order}',[OrderController::class,'changeOrderStatus'])->name('admin.market.order.changeOrderStatus');
            Route::get('/cancel-order/{order}',[OrderController::class,'cancelOrder'])->name('admin.market.order.cancelOrder');

        });

        // payment
        Route::prefix('payment')->group(function (){

            Route::get('/',[PaymentController::class,'index'])->name('admin.market.payment.index');
            Route::get('/online',[PaymentController::class,'online'])->name('admin.market.payment.online');
            Route::get('/offline',[PaymentController::class,'offline'])->name('admin.market.payment.offline');
            Route::get('/show/{payment}',[PaymentController::class,'show'])->name('admin.market.payment.show');
            Route::get('/cash',[PaymentController::class,'cash'])->name('admin.market.payment.cash');
            Route::get('/canceled/{payment}',[PaymentController::class,'canceled'])->name('admin.market.payment.canceled');
            Route::get('/returned/{payment}',[PaymentController::class,'returned'])->name('admin.market.payment.returned');
            Route::get('/confirm',[PaymentController::class,'confirm'])->name('admin.market.payment.confirm');

        });

        // product
        Route::prefix('product')->group(function (){

            Route::get('/',[ProductController::class,'index'])->name('admin.market.product.index');
            Route::get('/create',[ProductController::class,'create'])->name('admin.market.product.create');
            Route::post('/store',[ProductController::class,'store'])->name('admin.market.product.store');
            Route::get('/edit/{product}',[ProductController::class,'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}',[ProductController::class,'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{product}',[ProductController::class,'destroy'])->name('admin.market.product.destroy');
            Route::get('/status/{product}',[ProductController::class,'status'])->name('admin.market.product.status');
            Route::get('/marketable/{product}',[ProductController::class,'marketAble'])->name('admin.market.product.marketable');

            Route::get('/gallery/{product}',[GalleryController::class,'index'])->name('admin.market.gallery.index');
            Route::post('/gallery/{product}',[GalleryController::class,'store'])->name('admin.market.gallery.store');
            Route::delete('/gallery/{image}',[GalleryController::class,'destroy'])->name('admin.market.gallery.destroy');

            Route::get('/color/{product}',[ProductColorController::class,'index'])->name('admin.market.color.index');
            Route::get('/color/{product}/create',[ProductColorController::class,'create'])->name('admin.market.color.create');
            Route::post('/color/{product}',[ProductColorController::class,'store'])->name('admin.market.color.store');
            Route::delete('/color/{color}',[ProductColorController::class,'destroy'])->name('admin.market.color.destroy');

            Route::get('/guarantee/{product}',[ProductGuaranteeController::class,'index'])->name('admin.market.guarantee.index');
            Route::get('/guarantee/{product}/create',[ProductGuaranteeController::class,'create'])->name('admin.market.guarantee.create');
            Route::post('/guarantee/{product}',[ProductGuaranteeController::class,'store'])->name('admin.market.guarantee.store');
            Route::delete('/guarantee/{guarantee}',[ProductGuaranteeController::class,'destroy'])->name('admin.market.guarantee.destroy');


        });

        // property
        Route::prefix('property')->group(function (){

            Route::get('/',[PropertyController::class,'index'])->name('admin.market.property.index');
            Route::get('/create',[PropertyController::class,'create'])->name('admin.market.property.create');
            Route::post('/store',[PropertyController::class,'store'])->name('admin.market.property.store');
            Route::get('/edit/{attribute}',[PropertyController::class,'edit'])->name('admin.market.property.edit');
            Route::put('/update/{attribute}',[PropertyController::class,'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{attribute}',[PropertyController::class,'destroy'])->name('admin.market.property.destroy');

            Route::get('/value/{attribute}',[PropertyValueController::class,'index'])->name('admin.market.value.index');
            Route::get('/value/{attribute}/create',[PropertyValueController::class,'create'])->name('admin.market.value.create');
            Route::post('/value/{attribute}',[PropertyValueController::class,'store'])->name('admin.market.value.store');
            Route::get('/value/edit/{attribute}/{value}',[PropertyValueController::class,'edit'])->name('admin.market.value.edit');
            Route::put('/value/update/{attribute}/{value}',[PropertyValueController::class,'update'])->name('admin.market.value.update');
            Route::delete('/value/{value}',[PropertyValueController::class,'destroy'])->name('admin.market.value.destroy');

        });

        // store
        Route::prefix('store')->group(function (){

            Route::get('/',[StoreController::class,'index'])->name('admin.market.store.index');
            Route::get('/add-to-store/{product}',[StoreController::class,'addToStore'])->name('admin.market.store.addToStore');
            Route::post('/store/{product}',[StoreController::class,'store'])->name('admin.market.store.store');
            Route::get('/edit/{product}',[StoreController::class,'edit'])->name('admin.market.store.edit');
            Route::put('/update/{product}',[StoreController::class,'update'])->name('admin.market.store.update');


        });


    });


    Route::prefix('content')->group(function (){



        // banner
        Route::prefix('banner')->group(function (){

            Route::get('/',[BannerController::class,'index'])->name('admin.content.banner.index');
            Route::get('/create',[BannerController::class,'create'])->name('admin.content.banner.create');
            Route::post('/store',[BannerController::class,'store'])->name('admin.content.banner.store');
            Route::get('/edit/{banner}',[BannerController::class,'edit'])->name('admin.content.banner.edit');
            Route::put('/update/{banner}',[BannerController::class,'update'])->name('admin.content.banner.update');
            Route::delete('/destroy/{banner}',[BannerController::class,'destroy'])->name('admin.content.banner.destroy');
            Route::get('/status/{banner}',[BannerController::class,'status'])->name('admin.content.banner.status');

        });

        // comment
        Route::prefix('comment')->group(function (){

            Route::get('/',[ContentCommentController::class,'index'])->name('admin.content.comment.index');
            Route::get('/show/{comment}',[ContentCommentController::class,'show'])->name('admin.content.comment.show');
            Route::post('/store',[ContentCommentController::class,'store'])->name('admin.content.comment.store');
            Route::get('/edit/{comment}',[ContentCommentController::class,'edit'])->name('admin.content.comment.edit');
            Route::put('/update/{comment}',[ContentCommentController::class,'update'])->name('admin.content.comment.update');
            Route::delete('/destroy/{comment}',[ContentCommentController::class,'destroy'])->name('admin.content.comment.destroy');
            Route::get('/status/{comment}',[ContentCommentController::class,'status'])->name('admin.content.comment.status');
            Route::get('/approved/{comment}',[ContentCommentController::class,'approved'])->name('admin.content.comment.approved');
            Route::post('/answer/{comment}',[ContentCommentController::class,'answer'])->name('admin.content.comment.answer');

        });

        // FAQ
        Route::prefix('faq')->group(function (){

            Route::get('/',[FAQController::class,'index'])->name('admin.content.faq.index');
            Route::get('/create',[FAQController::class,'create'])->name('admin.content.faq.create');
            Route::post('/store',[FAQController::class,'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}',[FAQController::class,'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}',[FAQController::class,'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}',[FAQController::class,'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}',[FAQController::class,'status'])->name('admin.content.faq.status');



        });

        // Menu
        Route::prefix('menu')->group(function (){

            Route::get('/',[MenuController::class,'index'])->name('admin.content.menu.index');
            Route::get('/create',[MenuController::class,'create'])->name('admin.content.menu.create');
            Route::post('/store',[MenuController::class,'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}',[MenuController::class,'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}',[MenuController::class,'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}',[MenuController::class,'destroy'])->name('admin.content.menu.destroy');
            Route::get('/status/{menu}',[MenuController::class,'status'])->name('admin.content.menu.status');




        });

        // page
        Route::prefix('page')->group(function (){

            Route::get('/',[PageController::class,'index'])->name('admin.content.page.index');
            Route::get('/create',[PageController::class,'create'])->name('admin.content.page.create');
            Route::post('/store',[PageController::class,'store'])->name('admin.content.page.store');
            Route::get('/edit/{page}',[PageController::class,'edit'])->name('admin.content.page.edit');
            Route::put('/update/{page}',[PageController::class,'update'])->name('admin.content.page.update');
            Route::delete('/destroy/{page}',[PageController::class,'destroy'])->name('admin.content.page.destroy');
            Route::get('/status/{page}',[PageController::class,'status'])->name('admin.content.page.status');



        });



    });

    Route::prefix('user')->group(function (){

        // admin-user
        Route::prefix('admin-user')->group(function (){
                Route::get('/',[AdminUserController::class,'index'])->name('admin.user.admin-user.index');
                Route::get('/create',[AdminUserController::class,'create'])->name('admin.user.admin-user.create');
                Route::post('/store',[AdminUserController::class,'store'])->name('admin.user.admin-user.store');
                Route::get('/edit/{user}',[AdminUserController::class,'edit'])->name('admin.user.admin-user.edit');
                Route::put('/update/{user}',[AdminUserController::class,'update'])->name('admin.user.admin-user.update');
                Route::delete('/destroy/{user}',[AdminUserController::class,'destroy'])->name('admin.user.admin-user.destroy');
                Route::get('/status/{user}',[AdminUserController::class,'status'])->name('admin.user.admin-user.status');
                Route::get('/activation/{user}',[AdminUserController::class,'activation'])->name('admin.user.admin-user.activation');

                Route::get('/roles/{user}',[AdminUserController::class,'roles'])->name('admin.user.admin-user.roles');
                Route::post('/roles/{user}/store',[AdminUserController::class,'rolesStore'])->name('admin.user.admin-user.roles.store');

            Route::get('/permissions/{user}',[AdminUserController::class,'permissions'])->name('admin.user.admin-user.permissions');
            Route::post('/permissions/{user}/store',[AdminUserController::class,'permissionsStore'])->name('admin.user.admin-user.permissions.store');


        });

       // customer
        Route::prefix('customer')->group(function (){
            Route::get('/',[CustomerController::class,'index'])->name('admin.user.customer.index');
            Route::get('/create',[CustomerController::class,'create'])->name('admin.user.customer.create');
            Route::post('/store',[CustomerController::class,'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}',[CustomerController::class,'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}',[CustomerController::class,'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{user}',[CustomerController::class,'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}',[CustomerController::class,'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}',[CustomerController::class,'activation'])->name('admin.user.customer.activation');


        });

        // role
        Route::prefix('role')->group(function (){
            Route::get('/',[RoleController::class,'index'])->name('admin.user.role.index');
            Route::get('/create',[RoleController::class,'create'])->name('admin.user.role.create');
            Route::post('/store',[RoleController::class,'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}',[RoleController::class,'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}',[RoleController::class,'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}',[RoleController::class,'destroy'])->name('admin.user.role.destroy');
            Route::get('/permission-role/{role}',[RoleController::class,'permissionRole'])->name('admin.user.role.permission-role');
            Route::put('/permission-role/{role}',[RoleController::class,'permissionUpdate'])->name('admin.user.role.permission-update');


        });

        // permission
        Route::prefix('permission')->group(function (){
            Route::get('/',[PermissionController::class,'index'])->name('admin.user.permission.index');
            Route::get('/create',[PermissionController::class,'create'])->name('admin.user.permission.create');
            Route::post('/store',[PermissionController::class,'store'])->name('admin.user.permission.store');
            Route::get('/edit/{permission}',[PermissionController::class,'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{permission}',[PermissionController::class,'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{permission}',[PermissionController::class,'destroy'])->name('admin.user.permission.destroy');


        });




    });

    Route::prefix('notify')->group(function (){

        // email
        Route::prefix('email')->group(function (){
            Route::get('/',[EmailController::class,'index'])->name('admin.notify.email.index');
            Route::get('/create',[EmailController::class,'create'])->name('admin.notify.email.create');
            Route::post('/store',[EmailController::class,'store'])->name('admin.notify.email.store');
            Route::get('/edit/{email}',[EmailController::class,'edit'])->name('admin.notify.email.edit');
            Route::put('/update/{email}',[EmailController::class,'update'])->name('admin.notify.email.update');
            Route::delete('/destroy/{email}',[EmailController::class,'destroy'])->name('admin.notify.email.destroy');
            Route::get('/status/{email}',[EmailController::class,'status'])->name('admin.notify.email.status');
            Route::get('/send-mail/{email}',[EmailController::class,'sendMail'])->name('admin.notify.email.sendMail');


        });

        // email
        Route::prefix('email-file')->group(function (){
            Route::get('/{email}',[EmailFileController::class,'index'])->name('admin.notify.email-file.index');
            Route::get('{email}/create',[EmailFileController::class,'create'])->name('admin.notify.email-file.create');
            Route::post('{email}//store',[EmailFileController::class,'store'])->name('admin.notify.email-file.store');
            Route::get('/edit/{file}',[EmailFileController::class,'edit'])->name('admin.notify.email-file.edit');
            Route::put('/update/{file}',[EmailFileController::class,'update'])->name('admin.notify.email-file.update');
            Route::delete('/destroy/{file}',[EmailFileController::class,'destroy'])->name('admin.notify.email-file.destroy');
            Route::get('/status/{file}',[EmailFileController::class,'status'])->name('admin.notify.email-file.status');


        });

        // sms
        Route::prefix('sms')->group(function (){
            Route::get('/',[SMSController::class,'index'])->name('admin.notify.sms.index');
            Route::get('/create',[SMSController::class,'create'])->name('admin.notify.sms.create');
            Route::post('/store',[SMSController::class,'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}',[SMSController::class,'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}',[SMSController::class,'update'])->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}',[SMSController::class,'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}',[SMSController::class,'status'])->name('admin.notify.sms.status');


        });


    });

    Route::prefix('ticket')->group(function (){

            Route::get('/',[TicketController::class,'index'])->name('admin.ticket.index');
            Route::get('/new-tickets',[TicketController::class,'newTickets'])->name('admin.ticket.newTickets');
            Route::get('/open-tickets',[TicketController::class,'openTickets'])->name('admin.ticket.openTickets');
            Route::get('/close-tickets',[TicketController::class,'closeTickets'])->name('admin.ticket.closeTickets');
            Route::get('/show/{ticket}',[TicketController::class,'show'])->name('admin.ticket.show');
            Route::post('/store',[TicketController::class,'store'])->name('admin.ticket.store');
            Route::get('/edit/{ticket}',[TicketController::class,'edit'])->name('admin.ticket.sms.edit');
            Route::put('/update/{ticket}',[TicketController::class,'update'])->name('admin.ticket.update');
            Route::delete('/destroy/{ticket}',[TicketController::class,'destroy'])->name('admin.ticket.destroy');
            Route::get('/status/{ticket}',[TicketController::class,'status'])->name('admin.ticket.status');
            Route::post('/answer/{ticket}',[TicketController::class,'answer'])->name('admin.ticket.answer');



        Route::prefix('category')->group(function (){
            Route::get('/',[TicketCategoryController::class,'index'])->name('admin.ticket.category.index');
            Route::get('/create',[TicketCategoryController::class,'create'])->name('admin.ticket.category.create');
            Route::post('/store',[TicketCategoryController::class,'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{category}',[TicketCategoryController::class,'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{category}',[TicketCategoryController::class,'update'])->name('admin.ticket.category.update');
            Route::delete('/destroy/{category}',[TicketCategoryController::class,'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{category}',[TicketCategoryController::class,'status'])->name('admin.ticket.category.status');
        });

        Route::prefix('priority')->group(function (){
            Route::get('/',[TicketPriorityController::class,'index'])->name('admin.ticket.priority.index');
            Route::get('/create',[TicketPriorityController::class,'create'])->name('admin.ticket.priority.create');
            Route::post('/store',[TicketPriorityController::class,'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{priority}',[TicketPriorityController::class,'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{priority}',[TicketPriorityController::class,'update'])->name('admin.ticket.priority.update');
            Route::delete('/destroy/{priority}',[TicketPriorityController::class,'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{priority}',[TicketPriorityController::class,'status'])->name('admin.ticket.priority.status');
        });

        Route::prefix('admin')->group(function (){
            Route::get('/',[TicketAdminController::class,'index'])->name('admin.ticket.admin.index');
            Route::get('/set/{admin}',[TicketAdminController::class,'set'])->name('admin.ticket.admin.set');

        });



    });

    // setting
    Route::prefix('setting')->group(function (){
        Route::get('/',[SettingController::class,'index'])->name('admin.setting.index');
        Route::get('/edit/{setting}',[SettingController::class,'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}',[SettingController::class,'update'])->name('admin.setting.update');
        Route::delete('/destroy/{setting}',[SettingController::class,'destroy'])->name('admin.setting.destroy');

    });
    Route::post('/notification/read-all',[NotificationController::class,'readAll'])->name('admin.notification.readAll');


});

Route::get('login-register',[LoginRegisterController::class,'loginRegisterForm'])->name('auth.customer.login-register-form');
Route::middleware('throttle:customer-login-register-limiter')->post('login-register',[LoginRegisterController::class,'loginRegister'])->name('auth.customer.login-register');

Route::get('login-confirm/{token}',[LoginRegisterController::class,'loginConfirmForm'])->name('auth.customer.login-confirm-form');
Route::middleware('throttle:customer-login-confirm-limiter')->post('login-confirm/{token}',[LoginRegisterController::class,'loginConfirm'])->name('auth.customer.login-confirm');

Route::middleware('throttle:customer-login-resend-otp-limiter')->get('login-resend-otp/{token}',[LoginRegisterController::class,'loginResendOtp'])->name('auth.customer.login-resend-otp');

Route::get('logout',[LoginRegisterController::class,'logout'])->name('auth.customer.logout');

Route::get('/',[HomeController::class,'home'])->name('customer.home');
Route::get('/products/{category?}',[HomeController::class,'products'])->name('customer.products');
Route::get('/page/{page:slug}',[HomeController::class,'page'])->name('customer.page');

Route::get('/product/{product:slug}',[CustomerProductController::class,'product'])->name('customer.market.product');
Route::post('add-comment/product/{product:slug}',[CustomerProductController::class,'addComment'])->name('customer.market.add-comment');
Route::get('add-to-favorite/product/{product:slug}',[CustomerProductController::class,'addToFavorite'])->name('customer.market.add-to-favorite');

Route::get('add-to-compare/product/{product:slug}',[CustomerProductController::class,'addToCompare'])->name('customer.market.add-to-compare');

Route::get('add-rate/product/{product:slug}',[CustomerProductController::class,'addRate'])->name('customer.market.add-rate');

Route::get('cart',[CartController::class,'cart'])->name('customer.sales-process.cart');
Route::post('cart',[CartController::class,'updateCart'])->name('customer.sales-process.update-cart');
Route::post('add-to-cart/{product:slug}',[CartController::class,'addToCart'])->name('customer.sales-process.add-to-cart');
Route::post('remove-from-cart/{cartItem}',[CartController::class,'removeFromCart'])->name('customer.sales-process.remove-from-cart');


Route::get('address-and-delivery',[AddressController::class,'addressAndDelivery'])->name('customer.sales-process.address-and-delivery');
Route::post('add-address',[AddressController::class,'addAddress'])->name('customer.sales-process.add-address');
Route::put('update-address/{address}',[AddressController::class,'updateAddress'])->name('customer.sales-process.update-address');
Route::get('add-cities/{province}',[AddressController::class,'getCities'])->name('customer.sales-process.get-cities');
Route::post('choose-address-and-delivery',[AddressController::class,'chooseAddressAndDelivery'])->name('customer.sales-process.choose-address-and-delivery');

Route::get('payment',[CustomerPaymentController::class,'payment'])->name('customer.sales-process.payment');
Route::post('payment/couponDiscount',[CustomerPaymentController::class,'couponDiscount'])->name('customer.sales-process.couponDiscount');
Route::post('payment-submit',[CustomerPaymentController::class,'paymentSubmit'])->name('customer.sales-process.payment-submit');


Route::get('profile-completion',[ProfileCompletionController::class,'profileCompletion'])->name('customer.sales-process.profile-completion');
Route::post('profile-completion',[ProfileCompletionController::class,'update'])->name('customer.profile-completion.update');


Route::get('orders',[ProfileOrderController::class,'index'])->name('customer.profile.orders');

Route::get('my-favorites',[FavoriteController::class,'index'])->name('customer.profile.my-favorites');


Route::get('my-compares',[CompareController::class,'index'])->name('customer.profile.my-compares');

Route::get('my-profile',[ProfileController::class,'index'])->name('customer.profile.my-profile');

Route::put('my-profile',[ProfileController::class,'update'])->name('customer.profile.my-profile.update');

Route::get('my-addresses',[ProfileAddressController::class,'index'])->name('customer.profile.my-addresses');
Route::post('my-addresses',[ProfileAddressController::class,'store'])->name('customer.profile.my-addresses.store');

Route::get('my-tickets',[ProfileTicketController::class,'index'])->name('customer.profile.my-tickets');
Route::get('my-tickets/show/{ticket}',[ProfileTicketController::class,'show'])->name('customer.profile.my-tickets.show');
Route::get('my-tickets/status/{ticket}',[ProfileTicketController::class,'status'])->name('customer.profile.my-tickets.status');
Route::post('my-tickets/answer/{ticket}',[ProfileTicketController::class,'answer'])->name('customer.profile.my-tickets.answer');
Route::get('my-tickets/create',[ProfileTicketController::class,'create'])->name('customer.profile.my-tickets.create');
Route::post('my-tickets/store',[ProfileTicketController::class,'store'])->name('customer.profile.my-tickets.store');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('api-products',[CustomerProductController::class,'viewApi'])->name('customer.profile.viewApi');
