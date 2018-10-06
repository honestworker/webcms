<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|vacancy
*/

Route::group(['middleware' => 'global.settings'], function () {


    /* Front routes*/
    Route::get('/', 'Front\HomeController@index');

    Route::get('/rooms-suites', 'Front\RoomSuiteController@index');
    Route::get('/rooms-suites/{id}', 'Front\RoomSuiteController@index');

	Route::get('rooms-suites/show/{show}', ['as' => 'rooms-suites/show', 'uses' => 'Front\RoomSuiteController@show']);

    Route::get('/apartments', 'Front\ApartmentController@index');
    Route::get('/apartments/{id}', 'Front\ApartmentController@index');

    Route::get('apartments/show/{show}', ['as' => 'apartments/show', 'uses' => 'Front\RoomSuiteController@show']);


    Route::get('/promotions', 'Front\PromotionController@index');
    Route::get('/promotions/{id}', 'Front\PromotionController@index');

    Route::get('/dining', 'Front\DiningController@index');
    Route::get('/dining/{id}', 'Front\DiningController@index');

    Route::get('/facilities', 'Front\FacilitiesController@index');
    Route::get('/facilities/{id}', 'Front\FacilitiesController@index');

    Route::get('/weddings', 'Front\WeddingController@index');
    Route::get('/weddings/{id}', 'Front\WeddingController@index');

    Route::get('/events-meetings', 'Front\EventMeetingController@index');
    Route::get('/events-meetings/{id}', 'Front\EventMeetingController@index');

    Route::get('/about-us', 'Front\AboutUsController@index');
    Route::get('/about-us/{id}', 'Front\AboutUsController@index');

    Route::get('/gallery', 'Front\GalleryController@index');
    Route::get('/gallery/{id}', 'Front\GalleryController@index');

    Route::get('/contact-us', 'Front\ContactUsController@index');
    Route::post('/contact-us/create', 'Front\ContactUsController@create');
   // Route::get('/login', 'Front\LoginController@index');
   // Route::get('/create-account', 'Front\CreateAccountController@index');


    Route::get('/check-availability/check-discount', 'Front\CheckAvailController@checkDiscount');
    Route::get('/check-availability','Front\CheckAvailController@index');
    Route::post('/check-availability','Front\CheckAvailController@check_avail');
    Route::post('/make-cart','Front\CheckAvailController@saveCart');
    Route::post('/check-availability/signup','Front\CheckAvailController@signupForNotification');
    Route::get('/notify-success','Front\CheckAvailController@notifySuccess');






    // Route::get('/brand/{id}/{urlKey}', 'Front\BrandController@index');
    Route::get('/search_result', 'Front\HomeController@search_result');
    Route::post('/search_result', 'Front\HomeController@searchdata');
    Route::get('/category/{id}/{sort}/{item}/{page}', 'Front\CatalogController@index');
    Route::get('/create_account', 'Front\UserController@create_account');
    Route::post('/create_account', 'Front\UserController@create_account_register');
    Route::post('/users/getStates', 'Front\UserController@getStates');
    Route::get('/login', 'Front\UserController@login');
    Route::post('/login', 'Front\UserController@logincustomers');
    Route::post('user/sendOrderEmail', 'Front\UserController@sendemail');

    Route::post('/login/reset', 'Front\UserController@resetmail');
    Route::get('/passwordreset', 'Front\UserController@passwordreset');
    Route::post('/passwordreset', 'Front\UserController@passwordresetpost');


    Route::get('/logout', 'Front\UserController@logout');
    Route::get('/dashboard', ['as' => 'dashboard',
                                 'uses' => 'Front\UserController@dashboard'
                              ]);
     Route::get('/accountedit', ['as' => 'accountedit',
                                 'uses' => 'Front\UserController@accountEdit'
                                 ]);
    Route::post('/accountedit', 'Front\UserController@accountEdit');
    Route::get('/billingaddress', 'Front\UserController@billingaddress');
    Route::post('/billingaddress', 'Front\UserController@billingaddress');
    Route::get('/shippingaddress', 'Front\UserController@shippingaddress');
    Route::post('/shippingaddress', 'Front\UserController@shippingaddress');
    Route::post('/newsletter', 'Front\UserController@newsletter');
    Route::get('/orderhistory', ['as' => 'orderhistory',
                                  'uses' => 'Front\UserController@orderhistory'
                         ]);
    Route::get('/orderhistory/{sort}/{page}', 'Front\UserController@orderhistory');
    Route::get('/orderdetails/{id}', 'Front\UserController@orderdetails');
    Route::post('/newsletter/addSubscriber', 'Front\HomeController@addSubscriber');

    // index routes
    Route::get('web88cms/indexPopup', 'Admin\AdminController@popUp');
    Route::post('web88cms/indexPopup', 'Admin\AdminController@storePopUp');
    // Booking routes
    Route::get('web88cms/onScreenMessages', 'Admin\AdminController@booking');
    Route::post('web88cms/onScreenMessages', 'Admin\AdminController@updateBooking');
    Route::post('web88cms/booking/delete', 'Admin\AdminController@destroyBooking');
    Route::post('web88cms/add_on_screen_message', 'Admin\AdminController@storeOnScreenMessage');
    /* Admin Routes */

    Route::get('web88cms', 'Admin\AdminController@index');
    Route::get('/web88cms/login', 'Admin\AdminController@login');
   // Route::post('/auth/login', 'Auth\AuthController@postLogin');
    Route::get('/web88cms/logout', 'Admin\AdminController@logout');
//Route::get('/admin', 'Admin\AdminController@login');
//Route::get('admin', 'Admin\AdminController@index');
    Route::get('/web88cms/dashboard', 'Admin\AdminController@dashboard');
//    Route::get('/web88cms/checkInOut/{limit}', 'Admin\AdminController@checkInOutListing');
//    Route::get('/web88cms/checkInOut', 'Admin\AdminController@checkInOutListing');
    Route::get('/web88cms/checkInOut/{limit}', ['as' => 'checkInOut', 'uses' => 'Admin\AdminController@checkInOutListing']);
    Route::get('/web88cms/checkInOut', ['as' => 'checkInOut', 'uses' => 'Admin\AdminController@checkInOutListing']);
    Route::get('/web88cms/updatePassword/{id}', 'Admin\AdminController@updatePassword');
    Route::post('/web88cms/updatePassword/{id}', 'Admin\AdminController@updatePassword');

//Route::get('/admin/updateAvtar/{id}', 'Admin\AdminController@updatePassword');
    Route::post('/web88cms/updateAvtar/{id}', 'Admin\AdminController@updateAvtar');

//Route::get('/admin/categories/list/', 'Admin\CategoryController@listCategories');

    Route::get('/web88cms/categories/list/', 'Admin\CategoryController@listCategories');
    Route::get('/web88cms/categories/listAjax', 'Admin\CategoryController@listAjax');
    Route::post('/web88cms/categories/listAjax', 'Admin\CategoryController@listAjax');
    Route::post('/web88cms/categories/editCategory/{category_id}', 'Admin\CategoryController@editCategory');
    Route::get('/web88cms/categories/copyCategory/{category_id}', 'Admin\CategoryController@copyCategory');
    Route::get('/web88cms/categories/deleteCategory/{category_id}', 'Admin\CategoryController@deleteCategory');
    Route::post('/web88cms/categories/uploadMenuImage/{category_id}', 'Admin\CategoryController@uploadMenuImage');

    Route::get('/web88cms/categories/category_home_list', 'Admin\CategoryController@categoryhomelist');
    Route::post('/web88cms/categories/category_home_list', 'Admin\CategoryController@categoryhomelistpostdata');

    Route::get('/web88cms/categories/categoryhomelisttabajax/{id}', 'Admin\CategoryController@categoryhomelisttabajax');
    Route::get('/web88cms/categories/deleteTabsWithNoCategory', 'Admin\CategoryController@deleteTabsWithNoCategory');

    Route::get('/web88cms/categories/deletetabcategoryhomelisttabajax/{id}', 'Admin\CategoryController@deletetabcategoryhomelisttabajax');
    Route::get('/web88cms/categories/deleteallhomelisttabajax/{id}', 'Admin\CategoryController@delehomealllisttabajax');
    Route::get('/web88cms/categories/editcategoryhomelisttabajaxfortab/{id}', 'Admin\CategoryController@editcategoryhomelisttabajaxfortab');
    Route::get('/web88cms/categories/updateeditcategoryhomelisttabajaxfortab/{id}', 'Admin\CategoryController@updateeditcategoryhomelisttabajaxfortab');
    Route::post('/web88cms/categories/category_home_list/tablisting', 'Admin\CategoryController@tablistinghomelistpostdata');
    Route::post('/web88cms/categories/category_home_list/tablisting/ateditcatwithtab', 'Admin\CategoryController@tablistinghomelistateditcatwithtab');
    Route::post('/web88cms/categories/category_home_list/deletecatlist', 'Admin\CategoryController@deletecategoryhomelistpostdata');
    Route::post('/web88cms/categories/category_home_list/edittabenable', 'Admin\CategoryController@edittabenablecategoryhomelistpostdata');
    Route::post('/web88cms/categories/category_home_list/editcatlist', 'Admin\CategoryController@editcategoryhomelistpostdata');
    Route::post('/web88cms/categories/category_home_list/updatealltaborderedit', 'Admin\CategoryController@edit_update_display_order_all_tab_cat_home');

    Route::post('/web88cms/categories/category_home_list/deleteselectedcatlist', 'Admin\CategoryController@deleteselectcategorydata');
    Route::get('/web88cms/categories/category_home_list/deleteselectedAllhomecategorylistdata', 'Admin\CategoryController@deleteAlltopmiddle');
    Route::post('/web88cms/categories/category_home_list/edittablist', 'Admin\CategoryController@edittablisthomedata');
    Route::post('/web88cms/categories/category_home_list/edittablistmain', 'Admin\CategoryController@edittablisthomedatamain');
    Route::post('/web88cms/categories/category_home_list/deletetablist', 'Admin\CategoryController@deletetabhomelistpostdata');
    Route::post('/web88cms/categories/category_home_list/deleteselectedtablist', 'Admin\CategoryController@deleteselecttabdata');
    Route::post('/web88cms/categories/category_home_list/deleteselectedAllhometablistdata', 'Admin\CategoryController@deleteAlltabhomedata');
    Route::post('/web88cms/categories/category_home_list/updatealltaborder', 'Admin\CategoryController@update_display_order_all_tab_cat_home');
    Route::post('/web88cms/categories/category_home_list/updatealltaborder/edit', 'Admin\CategoryController@editdataupdate_display_order_all_tab_cat_home');
    Route::post('/web88cms/categories/category_home_list/deleteselectedtablistedit/{category_id}', 'Admin\CategoryController@deleteselecttabdataedit');
    Route::get('/web88cms/categories/category_home_list/deleteselectedAllhometablistdataedit/{category_id}', 'Admin\CategoryController@deleteAlltabhomedataedit');

    Route::get('/web88cms/categories/category_home_products_list', 'Admin\CategoryController@categoryhomeproductslist');
    Route::post('/web88cms/categories/category_home_products_list/addtabproducts', 'Admin\CategoryController@addtabproductsdata');
    Route::post('/web88cms/categories/category_home_products_list/updateallhome_products_list', 'Admin\CategoryController@update_display_order_allategory_home_products_list');
    Route::post('/web88cms/categories/category_home_products_list/deletechoosenhomeproduct', 'Admin\CategoryController@deletechoosenhomeproductfrmlist');
    Route::get('/web88cms/categories/category_home_products_list/deleteAllhomecategrylistdata', 'Admin\CategoryController@deleteAllhomecatlist');
    Route::post('/web88cms/categories/category_home_products_list/deleteselectcats', 'Admin\CategoryController@deleteselectedcatsdata');


    Route::get('/web88cms/categories/homeList', 'Admin\CategoryController@homeList');
    Route::get('/web88cms/categories/homeList/{limit}', 'Admin\CategoryController@homeList');

//Administrators Start
    Route::post('/web88cms/administrators/newAdministrator', 'Admin\AdministratorsController@newAdministrator');
    Route::get('/web88cms/administrators/delete/{administrator_id}', 'Admin\AdministratorsController@delete');
    Route::post('/web88cms/administrators/deleteAllAdministrator', 'Admin\AdministratorsController@deleteAllAdministrator');
    Route::post('/web88cms/administrators/getStates', 'Admin\AdministratorsController@getStates');
    Route::post('/web88cms/administrators/editAdministrator/{administrator_id}', 'Admin\AdministratorsController@editAdministrator');
    Route::get('/web88cms/administrators/csv', 'Admin\AdministratorsController@csv');
    Route::get('/web88cms/administrators/{limit}', 'Admin\AdministratorsController@index');
    Route::get('/web88cms/administrators/', 'Admin\AdministratorsController@index');
//Administrators End

//Customers Start
    Route::post('/web88cms/customers/newCustomer', 'Admin\CustomersController@newCustomer');
    Route::get('/web88cms/customers/delete/{customer_id}', 'Admin\CustomersController@delete');
    Route::post('/web88cms/customers/deleteAllCustomer', 'Admin\CustomersController@deleteAllCustomer');
    Route::get('/web88cms/customers/view/{customer_id}', 'Admin\CustomersController@view');
    Route::post('/web88cms/customers/view/{customer_id}', 'Admin\CustomersController@view');
    Route::post('/web88cms/customers/getStates', 'Admin\CustomersController@getStates');
    Route::post('/web88cms/customers/editCustomer/{customer_id}', 'Admin\CustomersController@editCustomer');
    Route::get('/web88cms/customers/deleteOrder/{customer_id}/{order_id}', 'Admin\CustomersController@deleteOrder');
    Route::get('/web88cms/customers/wishlistDetails/{wishlist_id}', 'Admin\CustomersController@wishlistDetails');
    Route::get('/web88cms/customers/specialListDetails/{special_id}', 'Admin\CustomersController@specialListDetails');
    Route::get('/web88cms/customers/csv', 'Admin\CustomersController@csv');
    Route::get('/web88cms/customers/{limit}', 'Admin\CustomersController@index');
    Route::get('/web88cms/customers/', 'Admin\CustomersController@index');
//Customers End

    /******************************************************************************************************************************/

    /* pwp */
    Route::post('/web88cms/pwp_save', ['uses' => 'Admin\PwpProductsController@postSave', 'as' => 'pwp.save']);
    Route::post('/web88cms/pwp_list', ['uses' => 'Admin\PwpProductsController@postList', 'as' => 'pwp.list']);
    Route::post('/web88cms/pwp_delete', ['uses' => 'Admin\PwpProductsController@postDelete', 'as' => 'pwp.delete']);

//update csv content via ajax
    Route::post('web88cms/shipping_method/update_csv', ['uses' => 'Admin\ShippingMethodsController@updateCsv', 'as' => 'ship.update.csv']);

    // Route::get('/web88cms/shipping/csv_import_list/', 'Admin\ShippingController@csvImportList');
    // Route::any('/web88cms/shipping/addShipping', 'Admin\ShippingController@addShipping');
    // Route::post('/web88cms/shipping/addShipping', 'Admin\ShippingController@addShipping');
    // Route::get('/web88cms/shipping/poslaju_edit/', 'Admin\ShippingController@csvPoslajuEdit');
    // Route::get('/web88cms/shipping/citylink_edit/', 'Admin\ShippingController@csvCitylinkEdit');
    // Route::get('/web88cms/shipping/by_category_list/', 'Admin\ShippingController@byCategoryList');
    // Route::get('/web88cms/shipping/by_weight_list/', 'Admin\ShippingController@byWeightList');
    // Route::get('/web88cms/shipping/by_total_amount_list/', 'Admin\ShippingController@byTotalAmountList');

    /*shipping*/
    Route::post('web88cms/shipping_method/setup', ['uses' => 'Admin\ShippingMethodsController@setup', 'as' => 'ship.setup']);
    Route::post('web88cms/shipping_method/delete', ['uses' => 'Admin\ShippingMethodsController@delete', 'as' => 'ship.delete']);
    Route::get('web88cms/shipping_method/edit_csv/{id}', ['uses' => 'Admin\ShippingMethodsController@editCsv', 'as' => 'ship.edit.csv']);
    Route::post('web88cms/shipping_method/options', ['uses' => 'Admin\ShippingMethodsController@getShippingOptions', 'as' => 'ship.option']);
    Route::get('web88cms/shipping_method/delete_file/{name}', ['uses' => 'Admin\ShippingMethodsController@deleteFile', 'as' => 'ship.delete.file']);
    Route::get('/web88cms/shipping_method/{type?}/{limit?}', ['uses' => 'Admin\ShippingMethodsController@index', 'as' => 'ship.index']);


//Orders Start
    Route::get('/web88cms/orders/detail/{order_id}', 'Admin\OrdersController@detail');
    Route::get('/web88cms/orders/deleteOrder/{customer_id}', 'Admin\OrdersController@deleteOrder');
    Route::post('/web88cms/orders/deleteAllOrder', 'Admin\OrdersController@deleteAllOrder');
    Route::get('/web88cms/orders/invoice/{id}', 'Admin\OrdersController@invoice');
    Route::post('/web88cms/orders/saveShippingAddress/{id}', 'Admin\OrdersController@saveShippingAddress');
    Route::post('/web88cms/orders/saveBillingAddress/{id}', 'Admin\OrdersController@saveBillingAddress');
    Route::post('/web88cms/orders/saveBillingAddress/{id}', 'Admin\OrdersController@saveBillingAddress');
    Route::post('/web88cms/orders/updateOrderStatus/{id}', 'Admin\OrdersController@updateOrderStatus');
    //Route::get('/web88cms/orders/updateOrderStatus/{id}', 'Admin\OrdersController@updateOrderStatus');
    Route::post('/web88cms/orders/updatePaymentStatus/{id}', 'Admin\OrdersController@updatePaymentStatus');
    Route::get('/web88cms/orders/shipmentsList/{limit}', 'Admin\OrdersController@shipmentsList');
    Route::get('/web88cms/orders/shipmentsList', 'Admin\OrdersController@shipmentsList');
    Route::get('/web88cms/orders/shipmentDetail/{id}', 'Admin\OrdersController@shipmentDetail');
    Route::post('/web88cms/orders/addNewShipment/{id}', 'Admin\OrdersController@addNewShipment');
    Route::post('/web88cms/orders/editNote/{id}', 'Admin\OrdersController@editNote');
    Route::get('/web88cms/orders/csv', 'Admin\OrdersController@csv');
    Route::get('/web88cms/orders/{limit}', 'Admin\OrdersController@index');
    Route::get('/web88cms/orders', 'Admin\OrdersController@index');
    Route::post('/web88cms/orders/viewPurchasedService', 'Admin\OrdersController@viewPurchasedService');
//Orders End

//promocodes Start
    Route::get('/web88cms/promocodes/addNew', 'Admin\PromocodesController@addNew');
    Route::post('/web88cms/promocodes/addNew', 'Admin\PromocodesController@addNew');
    Route::post('/web88cms/promocodes/deleteAllPromocode', 'Admin\PromocodesController@deleteAllPromocode');
    Route::get('/web88cms/promocodes/delete/{id}', 'Admin\PromocodesController@delete');
    Route::get('/web88cms/promocodes/{limit}', 'Admin\PromocodesController@index');
    Route::get('/web88cms/promocodes', 'Admin\PromocodesController@index');
    Route::get('/web88cms/promocodes/editPromoCode/{id}', 'Admin\PromocodesController@editPromoCode');
    Route::post('/web88cms/promocodes/editPromoCode/{id}', 'Admin\PromocodesController@editPromoCode');
    Route::post('/web88cms/promocodes/addPromoCodeCategory/{id}', 'Admin\PromocodesController@addPromoCodeCategory');
    Route::post('/web88cms/promocodes/addPromoCodeProduct/{id}', 'Admin\PromocodesController@addPromoCodeProduct');
    Route::post('/web88cms/promocodes/deletePromocodeToCategory/{id}', 'Admin\PromocodesController@deletePromocodeToCategory');
    Route::get('/web88cms/promocodes/deletePromocodeToCategory/{id}', 'Admin\PromocodesController@deletePromocodeToCategory');
    Route::post('/web88cms/promocodes/deletePromocodeToProduct/{id}', 'Admin\PromocodesController@deletePromocodeToProduct');
    Route::get('/web88cms/promocodes/deletePromocodeToProduct/{id}', 'Admin\PromocodesController@deletePromocodeToProduct');
//Orders End

// brands
    Route::get('/web88cms/brands/list/', 'Admin\BrandsController@listBrands');
    Route::post('/web88cms/brands/addBrand/', 'Admin\BrandsController@addBrand');
    Route::post('/web88cms/brands/updateBrand/', 'Admin\BrandsController@updateBrand');
    Route::post('/web88cms/brands/deleteBrands/', 'Admin\BrandsController@deleteBrands');

// colors
    Route::get('/web88cms/colors/list/', 'Admin\ColorsController@listColors');
    Route::get('/web88cms/colors/addColor/', 'Admin\ColorsController@addColor');
    Route::post('/web88cms/colors/addColor/', 'Admin\ColorsController@addColor');
    Route::get('/web88cms/colors/updateColor/{color_id}', 'Admin\ColorsController@updateColor');
    Route::post('/web88cms/colors/updateColor/{color_id}', 'Admin\ColorsController@updateColor');
    Route::post('/web88cms/colors/deleteColors/', 'Admin\ColorsController@deleteColors');

// products
    Route::get('/web88cms/products/addProduct/', 'Admin\ProductsController@addProduct');
    Route::post('/web88cms/products/addProduct/', 'Admin\ProductsController@addProduct');
    Route::post('/web88cms/products/editProduct/amenities/{product_id}', 'Admin\ProductsController@editProductAmenities');
    Route::get('/web88cms/products/editProduct/{product_id}', 'Admin\ProductsController@editProduct');
    Route::post('/web88cms/products/editProduct/{product_id}', 'Admin\ProductsController@editProduct');
    Route::get('/web88cms/products/deleteImage/{type}/{product_id}', 'Admin\ProductsController@deleteImage');
    Route::post('/web88cms/products/updateShippingInfo/{product_id}', 'Admin\ProductsController@updateShippingInfo');
    Route::get('/web88cms/products/list/', 'Admin\ProductsController@listProducts');
    Route::post('/web88cms/products/updateDescription/{product_id}', 'Admin\ProductsController@updateDescription');
    Route::post('/web88cms/products/updateFeaturedVideo/{product_id}', 'Admin\ProductsController@updateFeaturedVideo');
    Route::post('/web88cms/products/updateWarrantyAndSupport/{product_id}', 'Admin\ProductsController@updateWarrantyAndSupport');
    Route::post('/web88cms/products/updateReturnPolicy/{product_id}', 'Admin\ProductsController@updateReturnPolicy');
    Route::post('/web88cms/products/addImages/{product_id}', 'Admin\ProductsController@addImages');
    Route::get('/web88cms/products/deleteAdditionalImage/{image_id}/{product_id}', 'Admin\ProductsController@deleteAdditionalImage');
    Route::post('/web88cms/products/deleteProducts/', 'Admin\ProductsController@deleteProducts');
    Route::post('/web88cms/products/addQuantityDiscount/', 'Admin\ProductsController@addQuantityDiscount');
    Route::post('/web88cms/products/updateQuantityDiscount/', 'Admin\ProductsController@updateQuantityDiscount');
    Route::post('/web88cms/products/deleteQuantityDiscount', 'Admin\ProductsController@deleteQuantityDiscount');

// filters
    Route::any('/web88cms/filters/list/', 'Admin\FiltersController@listFilters');

// promotions
    Route::get('/web88cms/promotions/globalDiscounts/', 'Admin\PromotionsController@listGlobalDiscounts');
    Route::post('/web88cms/promotions/categoryProducts/', 'Admin\ProductsController@categoryProducts');
    Route::post('/web88cms/promotions/addGlobalDiscount/', 'Admin\PromotionsController@addGlobalDiscount');
    Route::post('/web88cms/promotions/deleteGlobalDiscounts/', 'Admin\PromotionsController@deleteGlobalDiscounts');
    Route::post('/web88cms/promotions/updateGlobalDiscount/', 'Admin\PromotionsController@updateGlobalDiscount');

// GST Rate start 
    Route::post('/web88cms/gstrates/newGstrate', 'Admin\GstratesController@newGstrate');
    Route::get('/web88cms/gstrates/delete/{gstrate_id}', 'Admin\GstratesController@delete');
    Route::post('/web88cms/gstrates/deleteAllGstrate', 'Admin\GstratesController@deleteAllGstrate');
    Route::post('/web88cms/gstrates/editGstrate/{administrator_id}', 'Admin\GstratesController@editGstrate');
    Route::get('/web88cms/gstrates/{limit}', 'Admin\GstratesController@index');
    Route::get('/web88cms/gstrates/', 'Admin\GstratesController@index');
    
// GST Rate End     
// set records per page
    Route::get('/web88cms/products/setPerPage/{per_page}/{session_key}/{redirect_to}/{query_string}', 'Admin\ProductsController@setPerPage');

// search site
    Route::post('/web88cms/searchSite/', 'Admin\AdministratorsController@searchSite');

//Notify users
    Route::post('/web88cms/notify/deleteAllNotify', 'Admin\NotifyController@deleteAllNotify');
    Route::get('/web88cms/notify/csv', 'Admin\NotifyController@csv');
    Route::get('/web88cms/notify', 'Admin\NotifyController@index');
    Route::get('/web88cms/notify/{limit}', 'Admin\NotifyController@index');

// front products
    Route::get('/products/{category_id}/{sort}', 'Front\ProductsController@listProducts');
    Route::get('/viewType/{view_type}', 'Front\ProductsController@viewType');
    Route::get('/products/setPerPage/{per_page}/{session_key}/{redirect_to}/{query_string}', 'Front\ProductsController@setPerPage');
    Route::get('/search/{sort}', 'Front\ProductsController@search');
    Route::get('/saveSearchTerm', 'Front\ProductsController@saveSearchTerm');

// wishlist
    Route::post('/addToWishlist', 'Front\WishlistsController@addToWishlist'); // add product to wishlist
    Route::get('/wishlist', 'Front\WishlistsController@wishlist'); // list wishlist
    Route::any('/getProductColors/{product_id}', 'Front\WishlistsController@getProductColors');
    Route::post('/addWishlist', 'Front\WishlistsController@addWishlist'); // add list
    Route::post('/deleteWishlist', 'Front\WishlistsController@deleteWishlist'); // delete wishlist
    Route::get('/wishlistDetails/{wishlist_id}', 'Front\WishlistsController@wishlistDetails'); // list wishlist
    Route::post('/renameWishlist', 'Front\WishlistsController@renameWishlist'); // delete wishlist
    Route::post('/deleteWishlistItem', 'Front\WishlistsController@deleteWishlistItem'); // delete wishlist Item/Product
    Route::post('/moveToWishlist', 'Front\WishlistsController@moveToWishlist'); // move product to wishlist
    Route::post('/updateWishlistItemsPriority', 'Front\WishlistsController@updateWishlistItemsPriority'); // update wishlist item priority
    Route::post('/wishlist/share', 'Front\WishlistsController@shareWishlist'); // share wishlist
    Route::get('/wishlist/view', 'Front\WishlistsController@viewWishlist'); // view share wishlist

// special list
    Route::any('/createEvent', 'Front\Special_listController@createEvent'); // create special list event
    Route::any('/events', 'Front\Special_listController@events'); // list events
    Route::post('/deleteEvent', 'Front\Special_listController@deleteEvent'); // delete Event
    Route::post('/event/share', 'Front\Special_listController@shareEvent'); // share wishlist
    Route::get('/event/view', 'Front\Special_listController@viewEvent'); // view share wishlist
    Route::get('/eventDetails/{event_id}', 'Front\Special_listController@eventDetails'); // event details
    Route::post('/deleteEventItem', 'Front\Special_listController@deleteEventItem'); // delete special list Item/Product
    Route::any('/loginRequired', 'Front\Special_listController@loginRequired'); // loginRequired
    Route::any('/editEvent/{event_id}', 'Front\Special_listController@editEvent'); // edit event
    Route::post('/event/categoryProducts/', 'Front\ProductsController@categoryProducts');
    Route::post('/event/productColors/', 'Front\ProductsController@productColors');
    Route::post('/event/addGift/', 'Front\Special_listController@addGift');

    Route::any('/token_expired/', 'TokenController@index');

//Product detail
    Route::post('/product/notifyMe', 'Front\ProductController@notifyMe');
    Route::get('/product/{id}', 'Front\ProductController@index');
    Route::get('/product/', 'Front\ProductController@index');

//Cart Start
    Route::get('/cart/', 'Front\CartController@index');
    Route::post('/cart/', 'Front\CartController@index');
    Route::get('/cart/cartHtml/', 'Front\CartController@cartHtml');
    Route::post('/cart/addToCart', 'Front\CartController@addToCart');
    Route::post('/cart/deleteToCart', 'Front\CartController@deleteToCart');
    Route::get('/cart/removeItem/{key}', 'Front\CartController@removeItem');
    Route::post('/cart/addAllToCart', 'Front\CartController@addAllToCart');
    Route::post('/cart/applyCouponCode', 'Front\CartController@applyCouponCode');
    Route::post('/cart/applyEstimateShipping', 'Front\CartController@applyEstimateShipping');
//Cart Ens

//Checkout Start
    //Route::get('/checkout', 'Front\CheckoutController@index');
    Route::post('/checkout', 'Front\CheckoutController@index');
    Route::post('/checkout/getStates', 'Front\CheckoutController@getStates');
    Route::get('/checkout/payment', 'Front\CheckoutController@payment');
    Route::get('/checkout/successPayment', 'Front\CheckoutController@successPayment');
    Route::post('/checkout/successPayment', 'Front\CheckoutController@successPayment');
    //Route::get('/checkout/orderConfirmation', array('as' => 'orderConfirmation', 'uses' => 'Front\CheckoutController@orderConfirmation'));
    Route::get('/checkout/orderConfirmation', array('as' => 'orderConfirmation', 'uses' => 'Front\CheckoutController@orderConfirmation'));
    Route::get('/checkout/orderConfirmation2', array('as' => 'orderConfirmation2', 'uses' => 'Front\CheckoutController@orderConfirmation2'));
	// Route::get('paypal/post', array('as' => 'addmoney.paypal', 'uses' => 'PaypalController@postPaymentWithpaypal'));
	Route::get('/checkout',['as' => 'addmoney.paywithpaypal','uses' => 'Front\CheckoutController@index']);
	Route::post('paypal/post', array('as' => 'addmoney.paypal', 'uses' => 'PaypalController@postPaymentWithpaypal'));
	Route::get('paypal', array('as' => 'payment.status', 'uses' => 'PaypalController@getPaymentStatus'));

    Route::post('/checkout/sendEmail', 'Front\CheckoutController@sendEmail');
//Checkout End

//Compare Start
    Route::get('/compare', 'Front\CompareController@index');
    Route::post('/compare/addToCompare', 'Front\CompareController@addToCompare');
    Route::get('/compare/deleteToCompare/{product_id}', 'Front\CompareController@deleteToCompare');
//Compare End

    Route::get('/web88cms/aboutusEdit', 'Admin\AdminController@aboutusEdit');
    Route::any('/web88cms/aboutusUpdate', 'Admin\AdminController@aboutusUpdate');
    Route::post('/web88cms/aboutusObjective', 'Admin\AdminController@aboutusObjective');
    Route::post('/web88cms/aboutusUpdateObjective', 'Admin\AdminController@aboutusUpdateObjective');
    Route::post('/web88cms/aboutusDeleteObjective', 'Admin\AdminController@aboutusDeleteObjective');

    /*********** Newsletter ******************/
    Route::get('/web88cms/newsletter', 'Admin\NewsletterController@index');
    Route::get('/web88cms/newsletter/{item}/{page}', 'Admin\NewsletterController@index');
    Route::post('/web88cms/newsletter/editSubscriber', 'Admin\NewsletterController@editSubscriber');
    Route::post('/web88cms/newsletter/addSubscriber', 'Admin\NewsletterController@addSubscriber');
    Route::post('/web88cms/newsletter/deleteSubscriber', 'Admin\NewsletterController@deleteSubscriber');
    Route::get('/web88cms/newsletter/deleteAll', 'Admin\NewsletterController@deleteAll');
    Route::get('/web88cms/newsletter/csv', 'Admin\NewsletterController@csv');

    /*********************** User Group ******************/
    Route::get('/web88cms/usergroups', 'Admin\UsergroupController@index');
    Route::get('/web88cms/usergroups/{item}', 'Admin\UsergroupController@index');
    Route::post('/web88cms/usergroups/editUsergroup', 'Admin\UsergroupController@editUsergroup');
    Route::post('/web88cms/usergroups/addUsergroup', 'Admin\UsergroupController@addUsergroup');
    Route::post('/web88cms/usergroups/deleteUsergroup', 'Admin\UsergroupController@deleteUsergroup');
    Route::get('/web88cms/usergroups/deleteAll', 'Admin\UsergroupController@deleteAll');

    /*********************** Banners ******************/
    Route::get('/web88cms/index_banner_top_list', 'Admin\AdminController@bannertop');
//Route::post('/web88cms/index_banner_top_list',  'Admin\BannerController@topbanner');
    Route::post('/web88cms/index_banner_top_list/addtopbanner', 'Admin\BannerController@topbanner');
    Route::post('/web88cms/index_banner_top_list/updateTopBannerdata', 'Admin\BannerController@updateTopBannerdata');
    Route::post('/web88cms/index_banner_top_list/deleteTopBannerdata', 'Admin\BannerController@deleteTopBannerdata');
    Route::post('/web88cms/index_banner_top_list/updatealltopbanner', 'Admin\BannerController@update_display_order_alltopbanner');
    Route::post('/web88cms/index_banner_top_list/deleteTopbanner', 'Admin\BannerController@deletemytopbanner');
    Route::get('/web88cms/index_banner_top_list/deleteAlltopdata', 'Admin\BannerController@deleteAll');
    Route::post('/web88cms/index_banner_top_list/delete_enlarge', 'Admin\BannerController@delete_enlargeimage_topbanner');
    Route::post('/web88cms/index_banner_top_list/delete_pdf', 'Admin\BannerController@delete_pdflink_topbanner');

    Route::post('/web88cms/index_banner_top_list/delete_banner_image', 'Admin\BannerController@delete_banner_image');
    Route::post('/web88cms/index_banner_top_list/delete_selected_banners', 'Admin\BannerController@deleteSelectedBanners');

    Route::get('/web88cms/index_middle_top_list', 'Admin\AdminController@bannermiddletop');

    Route::post('/web88cms/index_middle_top_list/addMiddleTopBanner', 'Admin\BannerController@middletopbanner');
    Route::post('/web88cms/index_middle_top_list/updateMiddleTopBanner', 'Admin\BannerController@updateMiddleTopBanner');
    Route::post('/web88cms/index_middle_top_list/deleteMiddleTopBanner', 'Admin\BannerController@deleteMiddleTopBanner');
    Route::post('/web88cms/index_middle_top_list/deleteselectedmiddleTopbanner', 'Admin\BannerController@deleteselectedmiddletopbanner');
    Route::get('/web88cms/index_middle_top_list/deleteselectedAllmiddletopdata', 'Admin\BannerController@deleteAlltopmiddle');
    Route::post('/web88cms/index_middle_top_list/updateallmiddletopbanner', 'Admin\BannerController@update_display_order_allmiddletopbanner');
    Route::post('/web88cms/index_middle_top_list/delete_enlarge', 'Admin\BannerController@delete_enlargeimage_middletopbanner');
    Route::post('/web88cms/index_middle_top_list/delete_pdf', 'Admin\BannerController@delete_pdflink_middletopbanner');

    Route::get('/web88cms/index_middle_bottom_list', 'Admin\AdminController@bannermiddlebottom');
    Route::post('/web88cms/index_middle_bottom_list/addMiddleBottomBanner', 'Admin\BannerController@middlebottombanner');
    Route::post('/web88cms/index_middle_bottom_list/updateMiddleBottomBanner', 'Admin\BannerController@updateMiddleBottomBanner');
    Route::post('/web88cms/index_middle_bottom_list/deleteMiddleBottomBanner', 'Admin\BannerController@deleteMiddleBottomBanner');
    Route::post('/web88cms/index_middle_bottom_list/deleteselectedmiddlebottombanner', 'Admin\BannerController@deleteselectedmiddlebottombanner');
    Route::get('/web88cms/index_middle_bottom_list/deleteselectedAllmiddlebottomdata', 'Admin\BannerController@deleteAllbottommiddle');
    Route::post('/web88cms/index_middle_bottom_list/updateallmiddlebottombanner', 'Admin\BannerController@update_display_order_allmiddlebottombanner');
    Route::post('/web88cms/index_middle_bottom_list/delete_enlarge', 'Admin\BannerController@delete_enlargeimage_middlebottombanner');
    Route::post('/web88cms/index_middle_bottom_list/delete_pdf', 'Admin\BannerController@delete_pdflink_middlebottombanner');

//Route::get('/web88cms/left_banner_list', 'Admin\AdminController@leftbanner');
    Route::get('/web88cms/left_banner_list', 'Admin\AdminController@leftbanner');
    Route::post('/web88cms/left_banner_list/addLeftBanner', 'Admin\BannerController@addLeftBanner');
    Route::post('/web88cms/left_banner_list/updateLeftBanner', 'Admin\BannerController@updateLeftBanner');
    Route::post('/web88cms/left_banner_list/deleteLeftBanner', 'Admin\BannerController@deleteLeftBanner');
    Route::post('/web88cms/left_banner_list/deleteselectedleftbanner', 'Admin\BannerController@deleteselectedleftbanner');
    Route::get('/web88cms/left_banner_list/deleteselectedAllleftdata', 'Admin\BannerController@deleteAllleft');
    Route::post('/web88cms/left_banner_list/updateallleftbanner', 'Admin\BannerController@update_display_order_all_left_banner');
    Route::post('/web88cms/left_banner_list/delete_enlarge', 'Admin\BannerController@delete_enlargeimage_leftbanner');
    Route::post('/web88cms/left_banner_list/delete_pdf', 'Admin\BannerController@delete_pdflink_leftbanner');

//Route::get('/web88cms/left_promotion_banner_list', 'Admin\AdminController@leftpromotionbanner');
    Route::get('/web88cms/left_promotion_banner_list', 'Admin\AdminController@leftpromotionbanner');
    Route::post('/web88cms/left_promotion_banner_list/addleftpromotionbanner', 'Admin\BannerController@addleftpromotionbanner');
    Route::post('/web88cms/left_promotion_banner_list/updateleftpromotionbanner', 'Admin\BannerController@updateleftpromotionbanner');
    Route::post('/web88cms/left_promotion_banner_list/deleteleftpromotionbanner', 'Admin\BannerController@deleteleftpromotionbanner');
    Route::post('/web88cms/left_promotion_banner_list/deleteselectedleftpromotionbanner', 'Admin\BannerController@deleteselectedleftpromotionbanner');
    Route::get('/web88cms/left_promotion_banner_list/deleteselectedAllleftpromotiondata', 'Admin\BannerController@deleteAllleftpromotion');
    Route::post('/web88cms/left_promotion_banner_list/updateallleftpromotionbanner', 'Admin\BannerController@update_display_order_all_left_promotion_banner');
    Route::post('/web88cms/left_promotion_banner_list/delete_enlarge', 'Admin\BannerController@delete_enlargeimage_leftpromotionbanner');
    Route::post('/web88cms/left_promotion_banner_list/delete_pdf', 'Admin\BannerController@delete_pdflink_leftpromotionbanner');

//Route::get('/web88cms/product_banner_list', 'Admin\AdminController@productbanner');
    Route::get('/web88cms/product_banner_list', 'Admin\AdminController@productbanner');
    Route::post('/web88cms/product_banner_list/addproductbanner', 'Admin\BannerController@addproductbanner');
    Route::post('/web88cms/product_banner_list/updateproductbanner', 'Admin\BannerController@updateproductbanner');
    Route::post('/web88cms/product_banner_list/deleteproductbanner', 'Admin\BannerController@deleteproductbanner');
    Route::post('/web88cms/product_banner_list/deleteselectedproductbanner', 'Admin\BannerController@deleteselectedproductbanner');
    Route::get('/web88cms/product_banner_list/deleteselectedAllproductdata', 'Admin\BannerController@deleteAllproduct');

    /******************************************************************************************************************************/
    /*promotions*/
    Route::get('web88cms/promotions/globaldiscountslist/', 'Admin\PromotionsController@index');

    /******************************************************************************************************************************/
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);


    /*Route::get('/admin/login', 'Admin\AdminController@login');
    Route::post('/admin/login', 'Admin\AdminController@login');
    Route::get('/admin/dashboard', 'Admin\AdminController@dashboard');
    Route::get('user/{id}', 'Admin\AdminController@getUserDetails');
    Route::get('albums', 'Admin\AdminController@getAlbums');
    Route::get('checkSession', 'Admin\AdminController@checkSession');*/

//Test
    Route::get('/mailTest', 'WelcomeController@mailTest');

    /******************************************************************************************************************************/
    /* web88 functions */
    Route::get('/about', 'Front\Web88Controller@about');
    Route::get('/vacancy', 'Front\Web88Controller@vacancy');
    Route::post('/vacancy', 'Front\Web88Controller@vacancy');
    Route::get('/services', 'Front\Web88Controller@services');
    Route::get('/stores', 'Front\Web88Controller@stores');
    Route::get('/contact', 'Front\Web88Controller@contact');
    Route::get('/contact/states', ['uses' => 'Front\Web88Controller@getStates', 'as' => 'Contact.states']);
    Route::post('/contact', 'Front\Web88Controller@postFeedback');
    Route::post('admin/addapplicant', 'Front\Web88Controller@Addapplicant');

    /*
    // web88 admin Settings
    Route::any('admin/header_setup', 'AdminController@Headersetup');
    Route::post('admin/addapplicant', 'AdminController@Addapplicant');
    Route::any('admin/footer_setup', 'AdminController@Footersetup');
    Route::any('admin/bottom_animated_services_list', 'AdminController@Animatedlist');
    Route::any('admin/newsletter_subscription_list', 'AdminController@Newsletter');
    Route::any('admin/forgot_password', 'AdminController@Newpassword');
    Route::get('admin/forgot/{data}', 'AdminController@Forgot');
    Route::get('admin/postEditobj', 'AdminController@postEditobj');
    */

// Exit Admin
    Route::get('admin/logout', function () {
        Auth::logout();
        return Redirect::to('admin/login');
    });
// Page login for Admin
    Route::any('admin/login', 'AdminController@login');
// Дей�?тви�? админа
    Route::group(array('before' => 'admin.auth'), function () {
        Route::controller('admin', 'AdminController');
    });
// Фильтр �?дмина
    Route::filter('admin.auth', function () {
        if (Auth::guest()) {
            return Redirect::to('admin/login');
        }
    });


    Route::get('/web88cms/globalsettings', function () {

        $settings = App\Http\Models\GlobalSettings::getSettings('global_open_close');
        $data = array(
            'success' => Session::get('global_settings.success'),
            'warning' => false,
            'setting' => json_decode($settings->value),
            'last_update' => $settings->updated_at,
        );
        Session::set('global_settings.success', '');

        return view('admin.global_settings_open_close', $data);
    });

    Route::get('/web88cms/prdouctglobalsetup', function () {
        $settings = \App\Http\Models\GlobalSettings::getSettings('product_global');
        $updated_at = $settings->updated_at;
        $settings = json_decode($settings->value);

        $data = array(
            'success' => Session::get('product_global_setup.success'),
            'warning' => Session::get('product_global_setup.warning'),
            'old_status' => ($settings->status) ? true : false,
            'last_update' => $updated_at,
        );
        Session::set('product_global_setup.success', '');
        Session::set('product_global_setup.warning', '');

        return view('admin.product_global_setup', $data);
    });

    Route::post('/web88cms/prdouctglobalsetup', 'Admin\ProductsController@importcsv');

    Route::post('/web88cms/globalsettings/save', function () {
        $json = array();
        $validation['password'] = 'required';
        $validator = Validator::make(Request::all(), $validation);

        $settings = array(
            'status' => (Request::get('status')) ? 1 : '0',
            'who' => Request::get('who'),
            'reopendate' => Request::get('reopendate'),
            'message' => Request::get('message'),
            'user_id' => Request::get('user_id'),
        );

        if ($validator->fails()) {

            $json['error'] = $validator->errors()->all();
        } else {
            if (Hash::check(Request::get('password'), Auth::user()->password)) {
                // save to model
                App\Http\Models\GlobalSettings::saveSettings('global_open_close', json_encode($settings));
                Session::put('global_settings.success', 'Setting saved successfully.');
                $json['success'] = 'TRUE';
            } else {
                $json['error'] = array('Password not matched with your password');
            }
        }


        return Response::json($json);
    });
});


Route::get('coming_soon', function () {
    $settings = \App\Http\Models\GlobalSettings::getSettings('global_open_close');

    $settings = json_decode($settings->value);
    $data = array(
        'reopendate' => $settings->reopendate,
        'message' => $settings->message,
    );

    return view('comming_soon', $data);
});
