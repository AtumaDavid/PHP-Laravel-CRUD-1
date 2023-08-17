<?php


use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

//to see all posts
// Route::get('/', function () {
//     $posts = Post::all();
//     return view('home', ["posts" => $posts]);
// });

// to see only logged in user post
Route::get('/', function () {
     $posts = [];
    
    if (auth()->check()) {
        $posts = Post::where("user_id", auth()->id())->get();
    }
   
    // $posts = [];
    // $posts = auth()->user()->userPosts()->latest()->get();
    return view('home', ["posts" => $posts]);
});

// Route::post('/register', function() {
//     return 'thank you';
// });
Route::post('/register', [UserController::class, "register"]);
Route::post('/logout', [UserController::class, "logout"]);
Route::post('/login', [UserController::class, "login"]);

//Blog post routes
Route::post("/create-post", [PostController::class, "createPost"]);
Route::get("/edit-post/{post}", [PostController::class, "showEditScreen"]);
Route::put("/edit-post/{post}", [PostController::class, "UpdatePost"]);
Route::delete("/delete-post/{post}", [PostController::class, "deletePost"]);
