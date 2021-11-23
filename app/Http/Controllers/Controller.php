<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *  version="0.001-BETA",
 *  title="API com login e senha",
 *  description="Minha api autenticada",
 *  @OA\Contact(
 *      name="Ariel",
 *      email="ariel@unisep.edu.br"
 *  )
 * )
 * @OA\Server(
 *  url=L5_SWAGGER_CONST_HOST,
 *  description="URL da api"
 * )
 * @OA\SecurityScheme(
 *  securityScheme="bearerAuth",
 *  description="Chave de acesso para a api",
 *  type="http",
 *  name="Authorization",
 *  in="header",
 *  scheme="bearer"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
