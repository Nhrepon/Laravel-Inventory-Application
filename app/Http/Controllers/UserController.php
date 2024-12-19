<?php

namespace App\Http\Controllers;

use App\Helper\JwtToken;
use App\Mail\Email;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }


    public function createUser(Request $request)
    {
        try{
            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);
            return response()->json([
                'status'=>'success',
                'message'=>'User create successfully',
                'data'=> $data,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e,
                //'message'=>$e->getMessage(),
    
            ]);
        }
    }



    public function userLogin(Request $request)
    {
        try{
            $data = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'));
            if($data !== 0){
                $token = JwtToken::generateToken($request->input('email'));
                return response()->json([
                    'status'=>'success',
                    'message'=>'User login successfully',
                    'token'=> $token,
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'User unauthorized',
                ]);
            }
            
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e,
                //'message'=>$e->getMessage(),
    
            ]);
        }
    }


    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);

        
        try{
            $data = User::where('email', $request->input('email'))->count();
            if($data !== 0){
                Mail::to($email)->send(new Email($otp));
                User::where('email', $request->input('email'))->update(['otp'=>$otp]);
                return response()->json([
                    'status'=>'success',
                    'message'=>'Send otp successfully',
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'Registration first or enter correct email.',
                ]);
            }
            
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e,
                //'message'=>$e->getMessage(),
    
            ]);
        }
    }




    public function verifyOtp(Request $request)
    {
        try{
            $data = User::where('email', $request->input('email'))
            ->where('otp', $request->input('otp'))->count();
            
            if($data !== 0){
                User::where('email', $request->input('email'))
                ->where('otp', $request->input('otp'))->update(['otp'=>'0']);

                $token = JwtToken::generateTokenForPasswordReset($request->input('email'));

                return response()->json([
                    'status'=>'success',
                    'message'=>'Otp verification successfully',
                    'token'=> $token,
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'User unauthorized',
                ]);
            }
            
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e,
                //'message'=>$e->getMessage(),
    
            ]);
        }
    }




    public function passwordReset(Request $request)
    {
        $email = $request->header('email');
        $password = $request->input("newPassword");
        try{
            $data = User::where('email', '=' , $email)
            ->update(['password' => $password]);

            return response()->json([
                'status'=>'success',
                'message'=>'Password reset successfully',
            ]);

            
        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e,
                //'message'=>$e->getMessage(),
    
            ]);
        }
    }













}
