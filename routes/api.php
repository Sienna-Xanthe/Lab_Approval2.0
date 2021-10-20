<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login')->middleware('auth.rolecheck'); //登录
    Route::post('logout', 'Login\LoginController@logout'); //退出登录
    Route::post('registered', 'Login\LoginController@registered'); //注册
    Route::get('position','Login\LoginController@position');//职位显示
});//--pxy

/**
 * 学生负责人test
 */
Route::middleware('student.check')->prefix('test')->group(function (){
   Route::post('pxy','Login\LoginController@test');
});

/**
 * 普通管理员test
 */
Route::middleware('ordinadmin.check')->prefix('test11')->group(function (){//
    Route::post('admin','Login\LoginController@admin');
});

/**
 * 超级管理员test
 */
Route::middleware('superadmin.check')->prefix('test22')->group(function (){
    Route::post('superadmin','Login\LoginController@superadmin');
});
/**
 * test
 */
Route::prefix('ttt')->group(function (){
    Route::post('asd','Login\LoginController@asd')->middleware('refreshToken');
});

/**
 * 超管分配账号
 */
Route::prefix('superadmin')->group(function (){
Route::post('assignaccount','SuperAdmin\AssignController@assign');
});
