<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *  name="Usuários"
 * )
 */
class RegisterController extends BaseController
{

    /**
     * @OA\Post(
     *  tags={"Usuários"},
     *  path="/register",
     *  operationId="register",
     *  summary="Cria um novo usuario",
     *  description="Metodo utilizado para que um novo usuario possa ser criado",
     *  @OA\RequestBody(
     *      description="Dados do usuario",
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/User")
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Realizado com sucesso",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="status", type="boolean", description="status"),
     *              @OA\Property(property="mensagem", type="string", description="mensagem")
     *          )
     *      )
     *  )
     * )
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()){
            return $this->sendError('Erro na validacao dos dados!', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('TRAVELCONTROL')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'Usuario registrado com sucesso!');
    }

    /**
     * @OA\Post(
     *  tags={"Usuários"},
     *  path="/login",
     *  operationId="login",
     *  summary="Efetua o login",
     *  description="Efetua o login na API",
     *  @OA\RequestBody(
     *      description="usuario que vai efetuar o login",
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="email", type="string", description="e-mail"),
     *              @OA\Property(property="password", type="string", description="senha")
     *          )
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Realizado com sucesso",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="status", type="boolean", description="status"),
     *              @OA\Property(property="mensagem", type="string", description="mensagem")
     *          )
     *      )
     *  )
     * )
     */
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('TRAVELCONTROL')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'Logado com sucesso!');
        } else{
            return $this->sendError('Nao autorizado', ['erro'=>'Nao autorizado']);
        }
    }
}
