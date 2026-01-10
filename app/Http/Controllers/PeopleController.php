<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PeopleController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->whereIn('role', ['user', 'assistant'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('people.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('people.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()
                ->route('people.index')
                ->with('error', 'Nie można usunąć konta administratora.');
        }

        if (Auth::id() === $user->id) {
            return redirect()
                ->route('people.index')
                ->with('error', 'Nie możesz usunąć własnego konta.');
        }

        $user->delete();

        return redirect()
            ->route('people.index')
            ->with('message', 'Użytkownik został usunięty.');
    }

    public function changeRole(User $user)
    {
        if ($user->role === 'admin') {
            abort(403);
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Nie można zmienić roli administratora.');
        }

        $user->role = $user->role === 'assistant' ? 'user' : 'assistant';
        $user->save();

        return back()->with('message', 'Rola użytkownika została zmieniona.');
    }
}
