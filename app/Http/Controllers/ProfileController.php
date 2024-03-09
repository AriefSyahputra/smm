<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index');
    }

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validation->fails()) {
            return $this->error(static::HTTP_BAD_REQUEST, $validation->getMessageBag());
        }

        $user = User::where('id', '=', Auth::user()->id)->first();

        if (!$user) {
            return $this->error(static::HTTP_NOT_FOUND,  $this->single_message("User Not Found"));
        }

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
        } else {
            return $this->error(static::HTTP__SERVER_ERROR,  $this->single_message("Current Password Invalid"));
        }

        return $this->success(static::HTTP_OK, static::UPDATE_OK);
    }
}
