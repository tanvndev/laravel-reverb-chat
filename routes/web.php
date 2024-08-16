<?php

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


Route::get('/dashboard', function () {
    $users = User::whereNot('id', Auth::id())->get();

    return view('dashboard', compact('users'));
})->middleware(['auth'])->name('dashboard');

Route::get('/chat/{user}', function (User $user) {
    return view('chat', [
        'user' => $user
    ]);
})->middleware(['auth'])->name('chat');

Route::get('messages/{user}', function (User $user) {
    return ChatMessage::query()
        ->where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $user->id);
        })
        ->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', Auth::id());
        })
        ->with(['sender', 'receiver'])
        ->orderBy('id', 'asc')
        ->get();
})->middleware(['auth']);

Route::post('messages/{user}', function (User $user) {
    $message = ChatMessage::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $user->id,
        'text' => request('text')
    ]);

    return $message;
});

require __DIR__ . '/auth.php';
