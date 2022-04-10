<?php

use App\Http\Controllers\UserCrudController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//TODO Route Задание 1: По GET урлу /hello отобразить view - /resources/views/hello.blade (без контроллера)
Route::get('/hello', function () {
    return view('hello');
});

//TODO Route Задание 2: По GET урлу / обратиться к IndexController, метод index
Route::get('/', 'App\Http\Controllers\IndexController@index');

//TODO Route Задание 3: По GET урлу /page/contact отобразить view - /resources/views/pages/contact.blade
// с наименованием роута - contact
Route::get('/page/contact', function () {
    return view('pages/contact');
})->name('contact');

//TODO Route Задание 4: По GET урлу /users/[id] обратиться к UserController, метод show
// без Route Model Binding. Только параметр id
Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');


//TODO Route Задание 5: По GET урлу /users/bind/[user] обратиться к UserController, метод showBind
// но в данном случае используем Route Model Binding. Параметр user
Route::get('/users/bind/{user}', 'App\Http\Controllers\UserController@showBind');
Route::model('user', User::class);
Route::bind('user', function ($value) {
    return User::where('id', $value)->firstOrFail();
});



//TODO Route Задание 6: Выполнить редирект с урла /bad на урл /good
Route::get('/bad', function () {
    return redirect('/good');
});


//TODO Route Задание 7: Добавить роут на ресурс контроллер - UserCrudController с урлом - /users_crud
Route::resource('users_crud', UserCrudController::class);



//TODO Route Задание 8: Организовать группу роутов (Route::group()) объединенных префиксом - dashboard
Route::prefix('dashboard')->group(function () {
// Задачи внутри группы роутов dashboard
    //TODO Route Задание 9: Добавить роут GET /admin -> Admin/IndexController -> index
    Route::get('/admin', 'App\Http\Controllers\Admin\IndexController@index');

    //TODO Route Задание 10: Добавить роут POST /admin/post -> Admin/IndexController -> post
    Route::post('/admin/post', 'App\Http\Controllers\Admin\IndexController@post');
});


//TODO Route Задание 11: Организовать группу роутов (Route::group()) объединенных префиксом - security и мидлваром auth
Route::prefix('security')->middleware('auth')->group(function () {
    // Задачи внутри группы роутов security
    //TODO Задание 12: Добавить роут GET /admin/auth -> Admin/IndexController -> auth
    Route::get('/admin/auth', 'App\Http\Controllers\Admin\IndexController@auth');
});


require __DIR__ . '/default.php';
