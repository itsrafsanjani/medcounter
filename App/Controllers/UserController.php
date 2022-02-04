<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    private static $instance;

    static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function index()
    {
        $user = new User();
        $users = $user->allExceptPassword();

        $this->response([
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function store()
    {
        $user = new User();

        $user->save([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ]);

        $this->response([], 201);
    }

    public function show($id)
    {
        $user = new User();

        $user = $user->showExceptPassword($id);

        $this->response([
            'data' => $user
        ], 200);
    }

    public function update($id)
    {
        $user = new User();

        $user->update([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ], $id);

        $this->response([], 200);
    }

    public function emailVerify($id)
    {
        $user = new User();

        $user->update([
            'email_verified_at' => $this->now(),
        ], $id);

        $this->response([], 200);
    }

    public function destroy($id)
    {
        $user = new User();

        $user->delete($id);

        $this->response([
            'message' => 'Successfully deleted!'
        ], 200);
    }

    // register

    // login
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $loggedIn = $user->loginAttempt($email, $password);

        if (!empty($loggedIn)) {
            // Generate a random string.
            $token = openssl_random_pseudo_bytes(16);

            // Convert the binary data into hexadecimal representation.
            $token = bin2hex($token);

            $user->update([
                'access_token' => $token
            ], $loggedIn['user']['id']);

            $this->response([
                'message' => 'Successfully deleted!',
                'access_token' => $token
            ], 200);
        } else {
            $this->response([
                'message' => 'Login failed! Email or password incorrect'
            ], 403);
        }
    }
}