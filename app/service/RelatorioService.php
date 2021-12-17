<?php
/**
 * User: Murillo
 * Date: 15/12/2021
 * Time: 13:13
 */

namespace App\service;

use App\Entities\Relatorio;
use App\Repositories\RelatorioRepository;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ApostaService {
    /**
     * @var RelatorioRepository
     */
    private $relatorioRepository;

    private $usuarioService;
    
    public function __construct(RelatorioRepository $relatorioRepository, UsuarioService $usuarioService) {
        $this->relatorioRepository = $relatorioRepository;
        $this->usuarioService = $usuarioService;
    }


    public function todos()
    {
        $todos = $this->relatorioRepository->all();
        return $todos;
    }


    public function todosOrdemDescCreated()
    {
        $todos = $this->relatorioRepository->orderBy('created_at', 'desc');
        return $todos;
    }

    
    public function todosOrdemDescDataPartida()
    {
        $todos = $this->relatorioRepository->orderBy('data_partida', 'desc');
        return $todos;
    }


    public function todosOrdemDescIdPartida()
    {
        $todos = $this->relatorioRepository->orderBy('partida_id', 'desc');
        return $todos;
    }


    public function todosGroupByIdPartida()
    {
        $todos = Relatorio::groupBy('partida_id')->get();
        return $todos;
    }


    public function todosGroupByDataPartida()
    {
        $todos = Relatorio::groupBy('data_partida')->get();
        return $todos;
    }


    public function buscarPorId($id)
    {
        $relatorio = $this->relatorioRepository->find($id);
        return $relatorio;
    }

    
	public function criar($data){
        $rules = [
            'aposta_id' => 'required',
            'usuario_id' => 'required',
            'usuario_nome' => 'required',
            'partida_id' => 'required',
            'valor_aposta' => 'required',
            'descricao_partida' => 'required',
            'data_partida' => 'required',
            'clube_mandante_id' => 'required',
            'clube_visitante_id' => 'required',
            'clube_mandante_nome' => 'required',
            'clube_visitante_nome' => 'required',
        ];
        $messages = [
            'required' => 'Campo obrigatório',
        ];
        $data->validate($rules, $messages);

        $usuario_id = Auth::id();
        $usuario_nome = Auth::user()->name;

        $relatorio = $this->relatorioRepository->create(array(//olhar novamente pra ver se está tudo correto
            'id' => (string) Uuid::uuid4(),
            'aposta_id' => $data->aposta_id,
            'usuario_id' => $usuario_id,
            'usuario_nome' => $usuario_nome,
            'partida_id' => $data->partida_id,
            'valor_aposta' => $data->valor_aposta,
            'descricao_partida' => $data->descricao_partida,
            'data_partida' => $data->data_partida,
            'clube_mandante_id' => $data->clube_mandante_id,
            'clube_visitante_id' => $data->clube_visitante_id,
            'clube_mandante_nome' => $data->clube_mandante_nome,
            'clube_visitante_nome' => $data->clube_visitante_nome,
            'placar_aposta_clube_mandante' => $data->placar_aposta_clube_mandante,
            'placar_aposta_clube_visitante' => $data->placar_aposta_clube_visitante,
            'aposta_em_empate' => $data->aposta_em_empate,
            'aposta_em_mandante' => $data->aposta_em_mandante,
            'aposta_em_visitante' => $data->aposta_em_visitante,
            'placar_oficial_mandante' => $data->placar_oficial_mandante,
            'placar_oficial_visitante' => $data->placar_oficial_visitante,
            'is_empate' => $data->is_empate,
            'is_vitoria_mandante' => $data->is_vitoria_mandante,
            'is_vitoria_visitante' => $data->is_vitoria_visitante,
            'valida' => $data->valida,
            'vencido' => $data->vencido,
        ));
        return $relatorio;
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
        $relatorio = $this->relatorioRepository->find($data->id);
        $relatorio->update(array(
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
        return $relatorio;
    }
    



}