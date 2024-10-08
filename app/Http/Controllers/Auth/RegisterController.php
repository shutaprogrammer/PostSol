<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Status;
use App\Models\Coin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tel' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'] ?? '000-0000-0000',
        ]);
        // ステータスレコードを作成（デフォルトで'Trial'）
        Status::create([
            
                'user_id' => $user->id, // ユーザーID
                'status' => 'Trial',    // 'Trial'ステータス
                'period' => now()->addDay(), // 1日後の期限を保存
                // 'period' => now()->addMonth(), // 1ヶ月後の期限を設定
            
        ]);
        // 2. 新しいコインレコードを作成して、amountに100を設定
        Coin::create([
            'user_id' => $user->id,  // ログインしているユーザーのIDを設定
            'amount' => 100,         // 100コインを追加
        ]);


        return $user;
    }

    protected function redirectTo()
    {
        return route('questions.index');
    }
}
