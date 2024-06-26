<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $driver = $request->has('driver') ? $request->driver : null;
        if (null == $driver) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'driver' => 'required|in:google'
            ]);
        }

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), "Validation Failed!", 400);
        }
        if (null != $driver) {
            $state = base64_encode(json_encode(['type' => 'register']));
            return $this->sendResponse([
                'url' => Socialite::driver($driver)->stateless()->redirect()->getTargetUrl() . '&state=' . urlencode($state),
            ], 'Redirection URL has been created Successfully !');
        } else {
            $user_data['name'] = $request->name;
            $user_data['email'] = $request->email;
            $user_data['password'] = bcrypt($request->password);
            User::insert($user_data);
            unset($user_data['password']);

        }


        return $this->sendResponse($user_data, "User Registered Successfully !", 200);
    }

    public function Login(Request $request)
    {
        $driver = $request->has('driver') ? $request->driver : null;

        if (null == $driver) {
            $validator = Validator::make($request->all(), [
                "email" => "required|string|email|exists:users,email",
                'password' => "required"
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'driver' => 'required|in:google'
            ]);
        }
        if ($validator->fails()) {
            return $this->sendError('Validation Failed.', $validator->errors(), 400);
        }

        if (null != $driver) {
            $state = base64_encode(json_encode(['type' => 'login']));
            return $this->sendResponse([
                'url' => Socialite::driver($driver)->stateless()->redirect()->getTargetUrl() . '&state=' . urlencode($state),
            ], 'Redirection URL has been created Successfully !');
        }

        $user = User::where('email', $request->get('email'))->first();
        $password = $request->get('password');
        if (!$user || !Hash::check($password, $user->password)) {
            return $this->sendError('Please Enter Valid Password !', [], 401);
        }
        $user_data['token'] = $user->createToken('authToken')->plainTextToken;
        return $this->sendResponse($user_data, "User LoggedIn Successfully !", 200);
    }

    public function Authcallback(Request $request, $driver)
    {
        $validator = Validator::make(["driver" => $driver], [
            'driver' => 'required|in:google,facebook,apple'
        ]);

        if (true === $validator->fails()) {
            $final_response = $this->sendError('Invalid driver.', $validator->errors(), 400);
            return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
        }

        try {
            $socialiteUser = Socialite::driver($driver)->stateless()->user();
        } catch (ClientException $e) {
            $final_response = $this->sendError('Invalid credentials provided.', $validator->errors(), 400);
            return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
        }

        $state = request()->input('state');
        $customVariable = json_decode(base64_decode($state), true);

        if (!empty($customVariable) && isset($customVariable['type']) && $customVariable['type'] == 'register') {
            $validator = Validator::make(["email" => $socialiteUser->getEmail()], [
                "email" => "required|string|email|unique:users,email",
            ]);

            if ($validator->fails()) {
                $final_response = $this->sendError('Validation Failed.', $validator->errors(), 400);
                return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
            }

            $user_data['name'] = $socialiteUser->name;
            $user_data['email'] = $socialiteUser->getEmail();
            $user_data['password'] = bcrypt("123456"); // need to change
            $user_data['profile_image'] = $socialiteUser->getAvatar();
            User::insert($user_data);
            unset($user_data['password']);

            $final_response = $this->sendResponse($user_data, 'User Sign Up Process done Successfully !');
            return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
        } else if (!empty($customVariable) && isset($customVariable['type']) && $customVariable['type'] == 'login') {
            $validator = Validator::make(["email" => $socialiteUser->getEmail()], [
                "email" => "required|string|email|exists:users,email",
            ]);

            if ($validator->fails()) {
                $final_response = $this->sendError('Validation Failed.', $validator->errors(), 400);
                return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
            }

            $user = User::where('email', $socialiteUser->getEmail())->first();
            if (!empty($user)) {
                $user_data['token'] = $user->createToken('authToken')->plainTextToken;
                $final_response = $this->sendResponse($user_data, 'User Logged In Successfully !');
                return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
            } else {
                $user_data['name'] = $socialiteUser->name;
                $user_data['email'] = $socialiteUser->getEmail();
                $user_data['password'] = bcrypt("123456"); // need to change
                $user_data['profile_image'] = $socialiteUser->getAvatar();
                User::insert($user_data);
                $user_data['token'] = $user->createToken('authToken')->plainTextToken;
                $final_response = $this->sendResponse($user_data, 'User Logged In Successfully !');
                return redirect(env('FRONTEND_URL') . '?data=' . base64_encode(json_encode($final_response->getOriginalContent())));
            }
        }
    }
}
