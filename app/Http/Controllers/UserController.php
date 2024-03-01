<?php

namespace App\Http\Controllers;

use App\Models\User;
use TurFramework\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function index(Request $request)
    {

        $users = User::query()->get();

        return view('pages.Users.list')->with('users', $users);
    }

    public function create()
    {

        return view('pages.Users.create');
    }

    public function store(StoreUserRequest $request)
    {

        $validatedRequest = $request->validated();

        User::query()->create($validatedRequest);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect()->to(route('users.list'))
            ->with('success', 'New User was added successfully.');
    }
    public function edit($id)
    {

        $user = User::query()->find($id);

        return view('pages.Users.edit')->with('user', $user);
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $validatedRequest = $request->validated();

        $user = User::query()->where('id', $id)->first();

        $user->update($validatedRequest);

        return redirect()->back()
            ->with('success', 'User was updated successfully.');
    }

    public function delete($id)
    {
        $user = User::query()->where('id', $id)->first();

        $user->delete();

        return redirect()->back()
            ->with('success', 'User was deleted successfully.');
    }
}
