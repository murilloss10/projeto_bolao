<?php
/**
 * User: Murillo
 * Date: 12/11/2021
 * Time: 17:24
 */

namespace App\service;

use App\Repositories\PartidaRepository;
use Carbon\Carbon;

class PartidaService {
    /**
     * @var PartidaRepository
     */
    private $partidaRepository;

    
    public function __construct(PartidaRepository $partidaRepository) {
        $this->partidaRepository = $partidaRepository;
    }


    public function todos(){
        $todos = $this->partidaRepository->all();
        return $todos;
    }


    public function todosPorOdemData(){
        $todos = $this->partidaRepository->all()->sortBy('partida_horario')->sortBy('partida_data');
        return $todos;
    }


    public function todosComApagados(){
        $todos = $this->partidaRepository->withTrashed()->get();
        return $todos;
    }


    public function buscarPorId($id){
        $partida = $this->partidaRepository->find($id);
        return $partida;
    }

    
	public function criar($data){
        $rules = [
            'campeonato' => 'required|max:36',
            'fase' => 'max:36',
            'clube_casa_id' => 'required',
            'clube_visitante_id' => 'required',
            'partida_data' => 'required',
            'partida_horario' => 'required',
            'local' => 'max:91',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'campeonato.max' => 'O nome deve ter no máximo 36 caracteres',
            'fase.max' => 'Este campo deve ter no máximo 36 caracteres',
            'local.max' => 'Este campo deve ter no máximo 91 caracteres'
        ];
        $data->validate($rules, $messages);
        $partida = $this->partidaRepository->create(array(
            'campeonato' => $data->campeonato,
            'rodada' =>  $data->rodada,
            'fase' => $data->fase,
            'clube_casa_id' => $data->clube_casa_id,
            'clube_visitante_id' => $data->clube_visitante_id,
            'partida_data' => $data->partida_data,
            'partida_horario' => $data->partida_horario,
            'local' => $data->local,
            'valida' => true,
        ));
        return $partida;
    }


	public function editar($data){
        $rules = [
            'campeonato' => 'required|max:36',
            'fase' => 'max:36',
            'clube_casa_id' => 'required',
            'clube_visitante_id' => 'required',
            'partida_data' => 'required',
            'partida_horario' => 'required',
            'local' => 'max:91',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
            'campeonato.max' => 'O nome deve ter no máximo 36 caracteres',
            'fase.max' => 'Este campo deve ter no máximo 36 caracteres',
            'local.max' => 'Este campo deve ter no máximo 91 caracteres'
        ];
        $data->validate($rules, $messages);

        if ($data->valida == 'Sim') {
            $valida = true;
        } elseif ($data->valida == 'Não') {
            $valida = false;
        }
        
        $partida = $this->partidaRepository->find($data->id);
        $partida->update(array(
            'campeonato' => $data->campeonato,
            'rodada' =>  $data->rodada,
            'fase' => $data->fase,
            'clube_casa_id' => $data->clube_casa_id,
            'clube_visitante_id' => $data->clube_visitante_id,
            'partida_data' => $data->partida_data,
            'partida_horario' => $data->partida_horario,
            'local' => $data->local,
            'valida' => $valida,
        ));
        return $partida;
    }
    

    public function apagar($id){
        $partida = $this->partidaRepository->find($id);
        $retorno = $partida->delete();
        return $retorno;
    }


    public function restaurarPartidaApagada($id){
        $partida = $this->partidaRepository->withTrashed()->find($id);
        $retorno = $partida->restore();
        return $retorno;
    }


    public function saidaTabela(){

        $partidas = $this->partidaRepository->all()->sortBy('partida_data')->sortBy('partida_horario');
        foreach ($partidas as $key => $partida) {
            
            $dados = [$key = [
                    'id' => $partida->id,
                    'campeonato' => $partida->campeonato,
                    'rodada' => $partida->rodada,
                    'fase' => $partida->fase,
                    'clube_casa_id' => $partida->clube_casa_id, //add apontamento para o ícone do clube
                    'clube_visitante_id' => $partida->clube_visitante_id,
                    'partida_data' => Carbon::parse($partida->partida_data)->format('d/m/Y'),
                    'partida_horario' => $partida->partida_horario,
                    'local' => $partida->local,
                    'valida' => $partida->valida,
                    'placar_oficial_mandante' => $partida->placar_oficial_mandante,
                    'placar_oficial_visitante' => $partida->placar_oficial_visitante,
                ]
            ];

        }

        // foreach ($dados as $key => $row){
        //     $partida_data[$key] = $row['partida_data'];
        // }
        // array_multisort($partida_data, SORT_ASC, $dados);

        return $dados;
        
    }


    public function alterarPlacar($data){

        $partida = $this->partidaRepository->find($data->id);
        $partida->update(array(
            'placar_oficial_mandante' => $data->placar_oficial_mandante,
            'placar_oficial_visitante' =>  $data->placar_oficial_visitante,
        ));
        return $partida;

    }




}