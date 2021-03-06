<?php

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




//===========================================================================
//管理者権限ユーザーのみ
//===========================================================================
Route::group(['middleware' => ['auth', 'can:admin']], function () {

  //管理画面
  //ユーザー
  Route::get('/admin/users',  'adminController@userIndex')->name('admin.user');
  Route::post('/admin/users',  'adminController@userIndex')->name('admin.user.search');
  Route::post('/admin/users/confirm/{id?}',  'adminController@userDeleteConfirm')->name('admin.user.deletes.confirm');
  Route::get('/admin/users/confirm/{id}',  'adminController@userDeleteConfirm')->name('admin.user.delete.confirm');
  Route::post('/admin/users/delete/{id?}',  'adminController@userDelete')->name('admin.user.delete');
  Route::get('/admin/users/{id}/edit',  'adminController@userEdit')->name('admin.user.edit');
  Route::post('/admin/users/{id}',  'adminController@userUpdate')->name('admin.user.update');

  //管理画面
  //プロダクト
  Route::get('/admin/products',  'adminController@productIndex')->name('admin.product');
  Route::post('/admin/products',  'adminController@productIndex')->name('admin.product.search');
  Route::get('/admin/products/{id}',  'adminController@productShow')->name('admin.product.show');
  Route::post('/admin/products/delete/{id}',  'adminController@productDeleteConfirm')->name('admin.product.delete.confirm');
  Route::get('/admin/products/delete/{id}',  'adminController@productDeleteConfirm')->name('admin.product.delete.confirm');
  Route::post('/admin/products/delete/{id?}',  'adminController@productDelete')->name('admin.product.delete');

  //管理画面
  //注文台帳
  Route::get('/admin/orders',  'adminController@orderIndex')->name('admin.order');
  Route::post('/admin/orders',  'adminController@orderIndex')->name('admin.order.search');
  Route::get('/admin/orders/{id}',  'adminController@orderShow')->name('admin.order.show');

  //管理画面
  //お問い合わせ台帳
  Route::get('/admin/contacts',  'adminController@contactIndex')->name('admin.contact');
  Route::post('/admin/contacts',  'adminController@contactIndex')->name('admin.contact.search');
  Route::get('/admin/contacts/{id}',  'adminController@contactShow')->name('admin.contact.show');
});

//===========================================================================
//全ユーザー閲覧可能
//===========================================================================
Auth::routes();

Route::get('/', function () {
  return view('index');
});

Route::group(['middleware' => 'basicauth'], function () {
  //ホーム
  Route::get('/',  'indexController@index')->name('home');
});


// 利用規約ページ
Route::get('/home/agreement', 'indexController@agreement')->name('home.agreement');
Route::get('/home/policy', 'indexController@policy')->name('home.policy');
Route::get('/home/tokutei', 'indexController@tokutei')->name('home.tokutei');

//お問い合わせ
Route::get('/contacts', 'ContactController@index')->name('contact.index'); //入力画面
Route::post('/contacts/confirm', 'ContactController@confirm')->name('contact.confirm'); //確認画面
Route::post('/contacts/finish', 'ContactController@send')->name('contact.send'); //完了画面
Route::get('/contacts/finish', 'ContactController@finish')->name('contact.finish'); //完了画面

//出品するボタンを押したときの銀行情報確認メソッド
Route::get('/ajaxbankconfirm', 'BankConfirmController@ajaxBankConfirm')->name('ajaxbankconfirm.ajaxbankconfirm');
//===========================================================================
//ログインユーザーのみ
//===========================================================================
Route::group(['middleware' => 'check'], function () {
  Route::get('/products/new', 'ProductsController@new')->name('products.new');
  Route::post('/products/new', 'ProductsController@create')->name('products.create');
  Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
  Route::post('/products/{id}/edit', 'ProductsController@update')->name('products.update');
  Route::post('/products/{id}/delete', 'ProductsController@delete')->name('products.delete');
  Route::post('/products/ajaxlike',  'LikesController@ajaxlike')->name('products.ajaxlike');
  Route::post('/products/ajaxfollow',  'FollowsController@ajaxfollow')->name('products.ajaxfollow');
  //レッスンの画像アップロード
  Route::post('/products/imgupload',  'LessonImgUploadController@imgupload')->name('products.imgupload');

  //レッスン編集画面で削除ボタンを押したときに、DBに既にあるレッスンだった場合はDBから削除
  Route::post('/products/ajaxLessonDelete',  'ProductsController@ajaxLessonDelete')->name('products.ajaxLessonDelete');

  //レッスン詳細
  Route::get('/products/{p_id}/{l_id}',  'LessonShowController@index')->name('lessons');


  //カート
  Route::get('/carts',  'CartsController@index')->name('carts');
  Route::post('/carts',  'CartsController@ajaxcart')->name('ajaxcarts');

  //マイページ
  Route::get('/mypage',  'mypageController@index')->name('mypage');
  Route::get('/mypage/edit',  'mypageController@edit')->name('mypage.edit');
  Route::post('/mypage/edit/{id}',  'mypageController@update')->name('mypage.update');
  Route::get('/mypage/draft',  'mypageController@draft')->name('mypage.draft');
  Route::get('/mypage/like',  'mypageController@like')->name('mypage.like');
  Route::get('/mypage/buy',  'mypageController@buy')->name('mypage.buy');
  Route::get('/mypage/sale',  'mypageController@sale')->name('mypage.sale');
  Route::get('/mypage/products',  'mypageController@products')->name('mypage.products');
  Route::get('/mypage/order',  'mypageController@order')->name('mypage.order');
  Route::get('/mypage/sold',  'mypageController@sold')->name('mypage.order.sold');

  //注文・トークルーム
  Route::post('/products/{id}',  'OrdersController@create')->name('orders.create');
  Route::get('/bords',  'BordsController@index')->name('bords');
  Route::get('/bords/{id}',  'BordsController@show')->name('bords.show');
  Route::post('/bords',  'MessagesController@create')->name('messages.create');



  //ユーザー
  Route::get('/profile/{id}/edit', 'ProfilesController@edit')->name('profile.edit');
  Route::post('/profile/{id}/edit', 'ProfilesController@update')->name('profile.update');
  Route::get('/profile/{id}/delete',  'ProfilesController@deleteShow')->name('profile.deleteShow');
  Route::post('/profile/{id}/delete',  'ProfilesController@deleteData')->name('profile.deleteData');
  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

  //パスワード変更
  Route::get('changepassword', 'HomeController@showChangePasswordForm');
  Route::post('changepassword', 'HomeController@changePassword')->name('changepassword');

  // メールアドレス確認メールを送信
  Route::get('/changeEmail', 'ChangeEmailController@index');
  Route::get('/reset/{token}', 'ChangeEmailController@reset');
  Route::post('/email', 'ChangeEmailController@sendChangeEmailLink');
});
//プロフィールページ
Route::get('/profile/{id}',  'ProfilesController@show')->name('profile.show');

Route::get('/products',  'ProductsController@index')->name('products');
Route::post('/products',  'ProductsController@index')->name('products');
Route::get('/products/{id}',  'ProductsController@shows')->name('products.show');
