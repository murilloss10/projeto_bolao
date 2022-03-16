<?php
/**
 * User: Murillo
 * Date: 21/10/2021
 * Time: 08:24
 */

namespace App\service;

use App\Repositories\ApostaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ApostaService {
    /**
     * @var ApostaRepository
     */
    private $apostaRepository;

    private $usuarioService;
    
    public function __construct(ApostaRepository $apostaRepository, UsuarioService $usuarioService) {
        $this->apostaRepository = $apostaRepository;
        $this->usuarioService = $usuarioService;
    }


    public function todos(){
        $todos = $this->apostaRepository->all();
        return $todos;
    }


    public function todosComApagados(){
        $todos = $this->apostaRepository->withTrashed()->get();
        return $todos;
    }


    public function buscarPorId($id)
    {
        $aposta = $this->apostaRepository->find($id);
        return $aposta;
    }

    
	public function criar($data){
        $rules = [
            'partida_id' => 'required',
            'placar_usuario_mandante' => 'required',
            'placar_usuario_visitante' => 'required',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
        ];
        $data->validate($rules, $messages);
        
        if ($data->usuario_id == NULL || $data->usuario_id == "") {
            $usuario_id = Auth::id();
        } else {
            $usuario = $this->usuarioService->buscarUsuarioPorCpf($data->usuario_id);
            $usuario_id = $usuario->first()->id;
        }

        $aposta = $this->apostaRepository->create(array(
            'id' => (string) Uuid::uuid4(),
            'partida_id' => $data->partida_id,
            'usuario_id' => $usuario_id,
            'placar_usuario_mandante' => $data->placar_usuario_mandante,
            'placar_usuario_visitante' => $data->placar_usuario_visitante,
            'valor_aposta' => 2,
            'valida' => false,
            'vencido' => false,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ));
        return $aposta;
    }


	public function editar($data){
        $rules = [
            'partida_id' => 'required',
            'usuario_id' => 'required',
            'placar_usuario_mandante' => 'required',
            'placar_usuario_visitante' => 'required',
            'valor_aposta' => 'required',
            'valida' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
        ];
        $data->validate($rules, $messages);
        $aposta = $this->apostaRepository->find($data->id);
        $aposta->update(array(
            'partida_id' => $data->partida_id,
            'usuario_id' => $data->usuario_id,
            'placar_usuario_mandante' => $data->placar_usuario_mandante,
            'placar_usuario_visitante' => $data->placar_usuario_visitante,
            'valor_aposta' => $data->valor_aposta,
            'valida' => $data->valida,
            'vencido' => $data->vencido,
            'created_by' => $data->created_by,
            'updated_by' => $data->updated_by,
        ));
        return $aposta;
    }
    

    public function apagar($id){
        $aposta = $this->apostaRepository->find($id);
        $retorno = $aposta->delete();
        return $retorno;
    }


    public function restaurarApostaApagada($id){
        $aposta = $this->apostaRepository->withTrashed()->find($id);
        $retorno = $aposta->restore();
        return $retorno;
    }


    public function validarAposta($id){
        $aposta = $this->apostaRepository->find($id);
        $aposta->update(array(
            'valida' => true,
        ));
        return $aposta;
    }


}