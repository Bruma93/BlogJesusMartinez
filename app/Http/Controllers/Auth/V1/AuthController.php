<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Excepetions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;

class AuthController extends Controller
{
    // Función para registrar usuarios
    public function register(Request $request){
        //Indicamos los parametros que queremos recibir del Request
        $data = $request->only ('name','email','password');

        //Validación
        $validator = Validator::make($data,[
            'name' => 'required|String',
            'email'=> 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
        ]);

        //Devolver un error si falla la validación
        if ($validator->fails()){
            return response()->json(['error' => $validator->message()], 400);
        }

        //Crear el usuario
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>bcrypt($request->password)
        ]);

        //Nos quedamos con el usuario y contraseña para hacer la peticion de token al JWTAuth
        $credentials = $request->only('email','password');

        return response()->json([
            'message' => 'user created',
            'token' => JWTAuth::attempt($credentials),
            'user' => $user
        ],Response::HTTP_OK);
    }

    //Función que utilizaremos para hacer login
        public function autenticate(Request $request){
            //Indicar los parametros que queremos recibir de la request
            $credentials = $request->only('email','password');

            //Validación
            $validator = Validator::make($credentials,[
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:50'
            ]);

            //Si la validación falla devolvemos un error
            if( $validator->fails()){
                return response()->json(['error' => $validator->messages()] ,400);
            }

            //Intentamos hacer login
         
            try{
                if(!$token = JWTAuth::attempt($credentials)){
                    //Credenciales incorrectas
                    return response()->json([
                        'error' => 'Error en las credenciales'
                    ], 401);
                }
            }catch (JWTException $e){
                //Error goooooordo
                return response()->json([
                    'message' => 'Error',
            ],500);
            }

            //Devolver el Token
            return response()->json([
                'token' => $token,
                'user' => Auth::user(),
            ]);

        }


        //Fucnion que elimina el token y desconecta al usuario
        public function logout(Request $request){
            //Valida que nos envia un token
            $validator = Validator::make($request->only('token'),[
                'token' => 'required'
            ]);

            //Fallo de validación
            if($validator->fails()){
                return response()->json(["error" => $validator->message()], 400);
            }
            //Si el token es válido, eliminamos el token desconectando al usuario
            try{
            JWTAuth::invalidate([$request->token]);
            return response()->json([
                'success' => true,
                'messaege' => "user disconected"
            ]);
            }catch(ExceptionsJWTException $e){
                return response()->json([
                    'success' => false,
                    'messaege' => "Error",
                    Response:: HTTP_INTERNAL_SERVER_ERROR
                ]);
            }
        }

        //Funcion que utilizaremos para obtener los datos del usuario y validar si el token ha expirado
        public function getUser(Request $request){

            //Validar que la request tenga el token

            $this->validate($request, [
                'token'=> 'required'
            ]);

            //Hacer la autenticación

            $user = JWTAuth::authenticate($request->token);


            


            //Si no obtenemios el usuario a partir del token, el token no es valido o ha expirado

            if(!$user){
                return response()->json([
                    'message'=> 'Invalid token / token expired'
                ], 401);
            }



            //Devolvemos los datos del usuario si todo va bien 
            return response()->json(['user'=>$user]);
            
        }
}
