<?php
/**
 * User: Murillo
 * Date: 21/10/2021
 * Time: 00:35
 */

namespace App\service;

use App\Repositories\ClubeRepository;

class ClubeService {
    /**
     * @var ClubeRepository
     */
    private $clubeRepository;

    
    public function __construct(ClubeRepository $clubeRepository) {
        $this->clubeRepository = $clubeRepository;
    }


    public function todos(){
        $todos = $this->clubeRepository->all();
        return $todos;
    }


    public function todosPorOdemNome(){
        $todos = $this->clubeRepository->all()->sortBy('nome');
        return $todos;
    }


    public function todosComApagados(){
        $todos = $this->clubeRepository->withTrashed()->get();
        return $todos;
    }


    public function buscarPorId($id){
        $clube = $this->clubeRepository->find($id);
        return $clube;
    }

    
	public function criar($data){
        $rules = [
            'nome' => 'required|max:36',
            'abreviacao' => 'required|max:5',
            'url_escudo' => 'required',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'nome.max' => 'O nome deve ter no máximo 36 caracteres',
            'abreviacao.max' => 'A abreviação deve ter no máximo 5 caracteres'
        ];
        $data->validate($rules, $messages);
        $clube = $this->clubeRepository->create(array(
            'nome' => $data->nome,
            'abreviacao' =>  strtoupper($data->abreviacao),
            'url_escudo' => $data->url_escudo,
        ));
        return $clube;
    }


	public function editar($data){ //editar
        $rules = [
            'nome' => 'required|max:36',
            'abreviacao' => 'required|max:5',
            'url_escudo' => 'required',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'nome.max' => 'O nome deve ter no máximo 36 caracteres',
            'abreviacao.max' => 'A abreviação deve ter no máximo 5 caracteres'
        ];
        $data->validate($rules, $messages);
        $clube = $this->clubeRepository->find($data->id);
        $clube->update(array(
            'nome' => $data->nome,
            'abreviacao' =>  strtoupper($data->abreviacao),
            'url_escudo' => $data->url_escudo,
        ));
        return $clube;
    }
    

    public function apagar($id){
        $clube = $this->clubeRepository->find($id);
        $retorno = $clube->delete();
        return $retorno;
    }


    public function restaurarClubeApagado($id){
        $clube = $this->clubeRepository->withTrashed()->find($id);
        $retorno = $clube->restore();
        return $retorno;
    }


}