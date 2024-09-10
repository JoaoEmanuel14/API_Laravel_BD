<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rota para listar todos os usuários
Route::get('usuarios', [UsuariosController::class, "index"]); 

//Rota para exibir os dados de um usuário em específico, caso ele exista
Route::get('usuarios/{cpf}', [UsuariosController::class, "acharUsuario"]);

//Rota para adicionar um usuário no banco de dados
Route::post('usuarios', [UsuariosController::class, "store"]);

