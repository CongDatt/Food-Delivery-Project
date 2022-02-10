<?php

use App\Http\Controllers\API\SocialLoginController;
use Kutia\Larafirebase\Facades\Larafirebase;
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
//Route::get('/', function () {
//    Larafirebase::withTitle('Công Đạt title')->withBody('Công Đạt đã đăng noti')->sendNotification('cgzVr_ckyU5-6yzpZmKMFg:APA91bESF9-LC2atY1f2dtjlcGnhHj996al1QvwwLnU4IAXxlPQxWHMlsLL8oC-QuITs_bO3YQZY30hoKpTyvySikls_ZfESB94ybUWIKH0qktGxS7C4bF9syIRU74MPM8vJVBuCuyuO');
//});
Route::get('login/{driver}',[SocialLoginController::class, 'redirectToSocial']);
