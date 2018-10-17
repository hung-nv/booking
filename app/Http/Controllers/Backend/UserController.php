<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Services\UserServices;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userServices;

    public function __construct(UserServices $userServices)
    {
        parent::__construct();
        $this->userServices = $userServices;
    }

    /**
     * Edit account information.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateAccount() {
        return view('backend.user.updateAccount');
    }

    /**
     * Update account information.
     * @param UpdateAccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function account(UpdateAccountRequest $request) {
        $this->userServices->updateAccountInformation($request->all());

        return redirect()->route('user.updateAccount')->with([
            'success' => 'Account Information has been update successful!'
        ]);
    }

    /**
     * Get all users.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userServices->getAllUsers();

        return view('backend.user.index', [
           'data' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Create user.
     * @param UserStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStore $request)
    {
        $this->userServices->createUser($request->all());

        return redirect()->route('user.index')->with([
            'success' => 'Your user has been create successful'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userServices->getUserById($id);

        return view('backend.user.update', [
            'data' => $user
        ]);
    }

    /**
     * Update user.
     * @param UserUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdate $request, $id)
    {
        $this->userServices->updateUserById($request->all(), $id);

        return redirect()->route('user.index')->with([
            'success' => 'Your user has been update'
        ]);
    }

    /**
     * Delete user.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->userServices->deleteUserById($id);

        return redirect()->route('user.index')->with([
            'success' => 'Your user has been delete'
        ]);
    }
}
