<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Validations\AuthValidation;
use Illuminate\Support\Facades\DB;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{

    /**
     * Class properties
     *
     * @var
     */
    private $otpService;
    private $authService;
    private $authValidation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authService = new AuthService;
        $this->authValidation = new AuthValidation;
    }

    /**
     * Register a new client
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = $this->authValidation->register($request->all());

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            DB::beginTransaction();
            $user = $this->authService->registerUser($request->toArray());
            DB::commit();

            //todo - send emails (production)

            $credentials = $request->only(['email', 'password']);
            $token = Auth::guard('api')->attempt($credentials);

            //send OPT to email
            // $this->sendMail('emails.otp', ["otp"=>$otp]);

            $data = [
                'user' => $user,
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60 * 24
            ];

            return $this->successResponse($data, 'Registration successful', 201);

        } catch (\Exception $e) {
            Log::error(['Error during registration: ' => $e->getMessage()]);
            return $this->errorResponse([ 'error'=>$e->getMessage(), 'message'=>'Something went wrong!'], 500);
        }
    }

    /**
     * Authenticate a client via login and return a JWT
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->authValidation->login($request->all());

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return $this->errorResponse('Invalid email or password!', 403);
        }

        $data = [
            'user' => Auth::user(),
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60 * 24
        ];

        return $this->successResponse($data, 'Authenticated successfully');
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return $this->successResponse(Auth::user(), 'Fetched loggd in user');
    }

}
