<?php

namespace App\Service;

use App\Helper\ResponseFormater;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store($data)
    {
        $validtor = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validtor->fails()) {
            return ResponseFormater::error($validtor->errors(), "Something Went Worng");
        }

        $register = $data->all();
        $register['password'] = bcrypt($register['password']);
        $user = $this->userRepository->save($register);
        $success['token'] =  $user->createToken('dais')->accessToken;
        $success['name'] =  $user->name;
        return ResponseFormater::success($success, "User Register Successfully");
    }

    public function login($data)
    {
        if (Auth::attempt(['email' => $data->email, 'password' => $data->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('dais')->accessToken;
            $success['name'] =  $user->name;
            return ResponseFormater::success($success, 'user login successfully');
        } else {
            return ResponseFormater::error(['error' => 'Unauthorized'], "unautorized");
        }
    }
}
