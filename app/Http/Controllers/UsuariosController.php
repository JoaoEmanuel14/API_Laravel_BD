<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API - Estudo da Tecnologia",
 *      description="API feita por João Emanuel para cumprimento da atividade Estudo da Tecnologia",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class UsuariosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/usuarios",
     *     summary="Listar todos os usuários",
     *     description="Exibe uma lista de todos os usuários cadastrados no banco de dados",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários",
     *     )
     * )
     */
    public function index() 
    {
        return response()->json(['usuarios' => Usuario::all()], 200);
    }

     /**
     * @OA\Post(
     *     path="/api/usuarios",
     *     summary="Cadastrar um novo usuário",
     *     description="Recebe os dados de um novo usuário e o cadastra no banco de dados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         required={"cpf", "nome", "data_nascimento"},
     *         @OA\Property(property="cpf", type="integer", example=2612),
     *         @OA\Property(property="nome", type="string", example="Renan"),
     *         @OA\Property(property="data_nascimento", type="string", format="date", example="2003-06-28")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário cadastrado com sucesso!"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Não foi possível cadastrar o usuário!"
     *     )
     * )
     */
    public function store(Request $req)
    {
        try 
        {
            Usuario::create([
            "cpf" => $req->cpf,
            "nome" => $req->nome,
            "data_nascimento" => $req->data_nascimento
            ]);

            return response()->json(['aviso' => 'Usuário cadastrado com sucesso!'], 200);

        } catch (Exception $e)
        {
            return response()->json(['aviso' => 'Não foi possível cadastrar o usuário!'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/usuario/{cpf}",
     *     summary="Exibe um usuário específico",
     *     description="Retorna os dados de um usuário com base no cpf fornecido",
     *     @OA\Parameter(
     *         name="cpf",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *          type="int", example=1234
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do usuário",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Usuário não encontrado!"
     *     )
     * )
     */
    public function acharUsuario($cpf)
    {
        try
        {
            $usuario = Usuario::findOrFail($cpf);
            return response()->json(['usuario' => $usuario], 200);
        } catch (Exception $e)
        {
            return response()->json(['aviso' => 'Usuário não encontrado!'], 500);
        }
    }
}
