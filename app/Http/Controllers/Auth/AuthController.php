<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\CreateRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    protected AuthService $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }
    public function login(AuthRequest $request)
    {

        try {
            $data = $request->validated();
            $response_data = $this->auth_service->login($data);

            return $this->responseOk($response_data);
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->auth_service->logout($request->user());
            return $this->responseOk([], 'Sesión cerrada correctamente');
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage(), 500);
        }
    }

    public function register(CreateRequest $request)
    {
        try {
            $data = $request->validated();
            $response_data = $this->auth_service->register($data);

            return $this->responseOk($response_data, 'Usuario registrado correctamente');
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage(), 500);
        }
    }
}
