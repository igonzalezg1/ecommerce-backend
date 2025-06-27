<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $filter = request()->input('filter', '');
            $paginate = request()->input('paginate', 5);
            $page = request()->input('page', 1);
            $response_data = $this->userService->index($filter, $paginate, $page);

            return $this->responseok($response_data, 'Lista de usuarios obtenida correctamente');
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $response_data = $this->userService->store($data);

            DB::commit();
            return $this->responseCreated($response_data, 'Usuario creado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $response_data = $this->userService->update($data, $user);

            DB::commit();
            return $this->responseOk($response_data, 'Usuario actualizado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $response_data = $this->userService->destroy($user);

            DB::commit();
            return $this->responseOk($response_data, 'Usuario eliminado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }
}
