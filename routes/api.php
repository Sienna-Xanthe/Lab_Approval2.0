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
    Route::post('position', 'Login\LoginController@position');//职位显示
});//--pxy

/**
 * 学生负责人test
 */
Route::middleware('student.check')->prefix('test')->group(function () {
    Route::post('pxy', 'Login\LoginController@test');
});

/**
 * 普通管理员test
 */
Route::middleware('ordinadmin.check')->prefix('test11')->group(function () {
    Route::post('admin', 'Login\LoginController@admin');
});

/**
 * 超级管理员test
 */
Route::middleware('superadmin.check')->prefix('test22')->group(function () {
    Route::post('superadmin', 'Login\LoginController@superadmin');
});

/**
 * 个人信息模块
 */
Route::prefix('info')->group(function () {
    Route::get('show', 'UserInfo\UserInfoController@show'); //个人信息展示
    Route::post('email', 'UserInfo\UserInfoController@email'); //发送邮箱更改状态码
    Route::post('skipRoute', 'UserInfo\UserInfoController@skipRoute'); //跳转路由
    Route::post('modifyPassword', 'UserInfo\UserInfoController@modifyPassword'); //修改密码
    Route::post('judgeAccount2', 'UserInfo\UserInfoController@judgeAccount2'); //判断account_state2的值为多少

});//--lyt

/**
 * 超级管理员--账号管理
 */
Route::prefix('manage')->group(function () {
    Route::get('showAll', 'SuperAdmin\ManagementStuController@showAll'); //显示所有的管理员信息
    Route::post('showAllPosition', 'SuperAdmin\ManagementStuController@showAllPosition'); //按照职位分类显示管理员信息
    Route::post('renewAdminState', 'SuperAdmin\ManagementStuController@renewAdminState'); //更改管理员状态
    Route::post('showInfoByName', 'SuperAdmin\ManagementStuController@showInfoByName'); //根据姓名查找个人信息
    Route::post('modifyPassword2', 'SuperAdmin\ManagementStuController@modifyPassword2'); //修改密码2
    Route::post('addAdmin', 'SuperAdmin\ManagementStuController@addAdmin'); //修改密码2

});//--lyt

/**
 * 学生端--设备归还
 */
Route::prefix('return')->group(function () {
    Route::get('showEquipmentReturn', 'StuAdmin\EquipmentReturnController@showEquipmentReturn'); //显示所有的管理员信息
    Route::post('addNote', 'StuAdmin\EquipmentReturnController@addNote'); //添加备注并更改状态
//    Route::post('changeReturn', 'StuAdmin\EquipmentReturnController@changeReturn'); //更改状态
});//--lyt

