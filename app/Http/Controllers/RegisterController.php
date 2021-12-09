<?php

namespace App\Http\Controllers;

use App\Helper\ResponseFormater as HelperResponseFormater;
// use App\Helpers\ResponseFormater;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    protected $user;
    public function __construct(UserService $userservice)
    {
        $this->user = $userservice;
    }
    public function register(Request $request)
    {
        return $this->user->store($request);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('dais')->accessToken;
            $success['name'] =  $user->name;
            return HelperResponseFormater::success($success, 'user login successfully');
        } else {
            return HelperResponseFormater::error(['error' => 'Unauthorized'], "unautorized");
        }
    }
}
