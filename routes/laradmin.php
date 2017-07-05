<?php

$namespacePrefix = '\\'.config('laradmin.controllers.namespace').'\\';

Route::get('login', [
    "uses" => "{$namespacePrefix}AuthController@showLoginForm",
    "as" => "login",
    "middleware" => "laradmin.gust"
]);

Route::post('logout', [
    "uses" => "{$namespacePrefix}AuthController@logout",
    "as" => "logout"
]);

Route::get('/', [
    "uses" => "{$namespacePrefix}DashboardController@index",
    "as" => "dashboard",
    "middleware" => "laradmin.user.admin"
]);

Route::get('/menu', [
    "uses" => "{$namespacePrefix}MenusController@index",
    "as" => "menus",
    "middleware" => "laradmin.user.admin"
]);

Route::group([
    "as" => "api.",
    "prefix" => "api/v1"],
    function() use ($namespacePrefix) {

    Route::get("/", ["uses" => "{$namespacePrefix}ApiController@health", "as" => "base"]);

    Route::post("/login", [
        "uses" => "{$namespacePrefix}AuthController@login",
        "as" => "post.login",
        "middleware" => "laradmin.gust"
    ]);

});