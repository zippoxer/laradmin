<?php

$namespacePrefix = '\\' . config('laradmin.controllers.namespace') . '\\';

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'laradmin.',
        'middleware' => [
            'web'
        ]
    ],
    function () use ($namespacePrefix) {

        Route::get('login', [
            "uses" => "{$namespacePrefix}AuthController@showLoginForm",
            "as" => "login",
            "middleware" => "laradmin.gust"
        ]);

        Route::post("login", [
            "uses" => "{$namespacePrefix}AuthController@login",
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

        Route::resource('menus', "{$namespacePrefix}MenusController", [
            "middleware" => "laradmin.user.admin"
        ]);

        Route::post('menus/item/validation', [
            "uses" => "{$namespacePrefix}MenusController@validateItem",
            "as" => "menus.item.validation",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::get('/types/query', [
            "uses" => "{$namespacePrefix}TypesBuilderController@query",
            "as" => "types.query",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::resource('types', "{$namespacePrefix}TypesBuilderController", [
            "middleware" => "laradmin.user.admin"
        ]);


        Route::get('/icons', [
            "uses" => "{$namespacePrefix}IconsController@index",
            "as" => "icons",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::post('{type}/uploads', [
            "uses" => "{$namespacePrefix}UploadsController@upload",
            "as" => "upload",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::get('serve-file/{mediaId}/{fileName}', [
            "uses" => "{$namespacePrefix}UploadsController@serve",
            "as" => "serve",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::get('relationship-query/{typeSlug}/{fieldKey}', [
            "uses" => "{$namespacePrefix}RelationshipController@query",
            "as" => "relationship.query",
            "middleware" => "laradmin.user.admin"
        ]);

        Route::post('relationship-create/{typeSlug}/{fieldKey}', [
            "uses" => "{$namespacePrefix}RelationshipController@simpleCreate",
            "as" => "relationship.create",
            "middleware" => "laradmin.user.admin"
        ]);

        foreach (\Shemi\Laradmin\Models\Type::all() as $type) {

            Route::get("/{$type->slug}/query", [
                "uses" => "{$type->controller}@query",
                "as" => "{$type->slug}.query",
                "middleware" => "laradmin.user.admin"
            ]);

            Route::resource($type->slug, $type->controller, [
                "middleware" => "laradmin.user.admin"
            ]);

        }

    }
);

