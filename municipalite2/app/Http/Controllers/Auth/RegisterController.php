<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
       * Register api
       *
       * @return \Illuminate\Http\Response
       */
      public function register(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'name' => 'required',
              'email' => 'required|email',
              'password' => 'required'
          ]);

          if($validator->fails()){
              return $this->sendError('Validation Error.', $validator->errors());
          }

          $input = $request->all();
          $input['password'] = bcrypt($input['password']);
          $user = User::create($input);
          $success['token'] =  $user->createToken('MyApp')->accessToken;
          $success['name'] =  $user->name;

          return $this->sendResponse($success, 'User register successfully.');
      }

      /**
       * Login api
       *
       * @return \Illuminate\Http\Response
       */
      public function login(Request $request)
      {
          if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
              $user = Auth::user();
              $success['token'] =  $user->createToken('MyApp')-> accessToken;
              $success['name'] =  $user->name;

              return $this->sendResponse($success, 'User login successfully.');
          }
          else{
              return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
          }
      }
}
