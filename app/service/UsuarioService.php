<?php
/**
 * User: Murillo
 * Date: 21/10/2021
 * Time: 00:50
 */

namespace App\service;

use App\Repositories\UsuarioRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UsuarioService {
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    
    public function __construct(UsuarioRepository $usuarioRepository, UserRepository $userRepository) {
        $this->usuarioRepository = $usuarioRepository;
        $this->userRepository = $userRepository;
    }


    public function todos(){
        $todos = $this->usuarioRepository->all();
        return $todos;
    }


    public function todosComApagados(){
        $todos = $this->usuarioRepository->withTrashed()->get();
        return $todos;
    }


    public function perfilUser(){
        $idUser = Auth::id();
        $user = $this->userRepository->where('id', $idUser)->first();
        return $user;
    }


    public function perfilUsuario(){
        $idUser = Auth::id();
        $usuario = $this->usuarioRepository->where('user_id', $idUser)->first();
        return $usuario;
    }


    public function perfilUserBusca($id){
        $user = $this->userRepository->where('id', $id)->first();
        return $user;
    }


    public function perfilUsuarioBusca($id){
        $usuario = $this->usuarioRepository->where('user_id', $id)->first();
        return $usuario;
    }


    public function buscarUsuarioPorCpf($cpf)
    {
        $usuario = $this->userRepository->where('cpf', $cpf)->get();
        return $usuario;
    }

    
	public function criar($data){
        $rules = [
            'user_id' => 'required',
            'sobrenome' => 'required|max:36',
            'cpf' => 'required|max:14', //adicionar depois o campo de único
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'sobrenome.max' => 'O sobrenome deve ter no máximo 36 caracteres',
            'cpf.max' => 'O CPF deve ter no máximo 14 caracteres'
        ];
        $data->validate($rules, $messages);
        $usuario = $this->usuarioRepository->create(array(
            'user_id' => $data->user_id,
            'sobrenome' =>  $data->sobrenome,
            'cpf' => $data->cpf,
        ));
        return $usuario;
    }


	public function editar($data, $id){
        $rules = [
            'user_id' => 'required',
            'sobrenome' => 'required|max:36',
            'cpf' => 'required|max:14', //adicionar depois o campo de único
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'sobrenome.max' => 'O sobrenome deve ter no máximo 36 caracteres',
            'cpf.max' => 'O CPF deve ter no máximo 14 caracteres'
        ];
        $data->validate($rules, $messages);
        $usuario = $this->usuarioRepository->where('user_id', $id)->get();
        $usuario->update(array(
            'user_id' => $id,
            'sobrenome' =>  $data->sobrenome,
            'cpf' => $data->cpf,
        ));
        return $usuario;
    }
    

    public function apagar($id){
        $usuario = $this->usuarioRepository->where('user_id', $id)->get();
        $retorno = $usuario->delete();
        return $retorno;
    }


    public function restaurarUsuarioApagado($id){
        $usuario = $this->usuarioRepository->where('user_id', $id)->get();
        $retorno = $usuario->restore();
        return $retorno;
    }


}