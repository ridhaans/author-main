<?php

namespace App\Http\Controllers;

use App\Utils\ApiResponse;
use App\Utils\ResponseCode;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller

{
    use ApiResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return list of users
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        // return $this->errorResponse('Gagal', '109');
        return $this->validResponse($users);
    }

    /**
     * Store new user data
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];
        $this->validate($request, $rules);
        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        $user = User::create($fields);
        return $this->validResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Show user detail
     * @return Illuminate\Http\Response
     */
    public function show($userId)
    {

        $user = User::findOrFail($userId);
        return $this->validResponse($user, Response::HTTP_OK);
    }

    /**
     * Store new user data
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8|confirmed'
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($userId);
        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must be changed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->validResponse($user, Response::HTTP_OK);
    }

    /**
     * Show user detail
     * @return Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return $this->validResponse($user, Response::HTTP_OK);
    }


    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
