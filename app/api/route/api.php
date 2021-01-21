<?php
use think\facade\Route;
Route::group('v1',function (){
    Route::any('user/:action','v1.User/:action');
    Route::any('common/:action','v1.Common/:action');
    Route::any('story/:action','v1.Story/:action');
});