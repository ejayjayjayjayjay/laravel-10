<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use OpenAI\Laravel\Facades\OpenAI;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
    /* RAW SQL QUERIES */

    // Select user
    //$users = DB::select("SELECT * FROM users");

    // Create new user
    //$users = DB::insert('insert into users (name, email,password) values (?, ?,?)', ['test2', 'test2@gmail.com','admin123']);

    // Update user
    //$users = DB::update("UPDATE users SET name = ? WHERE id = ?", ['test4', 2]);

    // Delete user
    //$users = DB::delete("DELETE from users WHERE id = ?", [2]);

    /* QUERY BUILDERS */

    // Select user
    //$users = DB::table('users')->find(3);

    // Create new user
    // $users = DB::table('users')->insert([
    //     'name' => 'test3',
    //     'email' => 'test3@gmail.com',
    //     'password' => 'admin123'
    // ]);

    // Update user
    // $users = DB::table('users')->where('id', 4)->update([
    //     'name' => 'test3'
    // ]);

    // Delete user

    //$users = DB::table('users')->where('id', 4)->delete();

    /* ELOQUENT ORM */

    // Select user
    // $users = User::find(7);

    // Create new user
    // $users = User::create([
    //     'name' => 'test10',
    //     'email' => 'test10@gmail.com',
    //     'password' => 'admin123'
    // ]);

    // Update user
    // $users = User::find(7);
    // $users->name = "josell";
    // $users->save();

    // Delete user
    // $users = User::find(5);
    // $users->delete();

    /* dd($users); */
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar',[AvatarController::class, 'update'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/openai', function() {

    $result = OpenAI::completions()->create([
    'model' => 'text-davinci-003',
    'prompt' => 'PHP is',
]);

    echo $result['choices'][0]['text']; // an open-source, widely-used, server-side scripting language.
});
