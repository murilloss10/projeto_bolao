<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PartidaCreateRequest;
use App\Http\Requests\PartidaUpdateRequest;
use App\Repositories\PartidaRepository;
use App\service\ClubeService;
use App\service\PartidaService;
use App\Validators\PartidaValidator;

/**
 * Class PartidasController.
 *
 * @package namespace App\Http\Controllers;
 */
class PartidasController extends Controller
{
    /**
     * @var PartidaRepository
     */
    protected $repository;

    /**
     * @var PartidaValidator
     */
    protected $validator;

    /**
     * @var ClubeService
     */
    protected $clubeService;

    /**
     * @var PartidaService
     */
    protected $partidaService;


    /**
     * PartidasController constructor.
     *
     * @param PartidaRepository $repository
     * @param PartidaValidator $validator
     */
    public function __construct(PartidaRepository $repository, PartidaValidator $validator, ClubeService $clubeService, PartidaService $partidaService)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->clubeService = $clubeService;
        $this->partidaService = $partidaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $partidas = $this->partidaService->todosPorOdemData();
        $clubes = $this->clubeService->todosPorOdemNome();
        $dados = [
            'partidas' => $partidas,
            'clubes' => $clubes,
        ];
        return view('partidas.partidas', $dados);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PartidaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PartidaCreateRequest $request)
    {
        try {

            if ($request->clube_casa_id == $request->clube_visitante_id) {
                $mensagem = 'O clube mandante e clube visitante devem ser diferentes!';
                $dados = [
                    'mensagem' => $mensagem
                ];
            } else {
                $partida = $this->partidaService->criar($request);
                $mensagem = 'Partida adicionada com sucesso!';
                $dados = [
                    'partida' => $partida,
                    'mensagem' => $mensagem
                ];
            }
            return redirect()->route('partidas.index', $dados);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PartidaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PartidaUpdateRequest $request)
    {
        try {

            if ($request->clube_casa_id == $request->clube_visitante_id) {
                $mensagem = 'O clube mandante e clube visitante devem ser diferentes!';
                $dados = [
                    'mensagem' => $mensagem
                ];
            } else {
                $partida = $this->partidaService->editar($request);
                $mensagem = 'Partida alterada com sucesso!';
                $dados = [
                    'partida' => $partida,
                    'mensagem' => $mensagem
                ];
            }
            return redirect()->route('partidas.index', $dados);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Partida deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Partida deleted.');
    }


    public function formEditar($id){
        $partida_editar = $this->repository->find($id);
        $partidas = $this->partidaService->todosPorOdemData();
        $clubes = $this->clubeService->todosPorOdemNome();
        $dados = [
            'partida_editar' => $partida_editar,
            'partidas' => $partidas,
            'clubes' => $clubes,
        ];
        return view('partidas.partidas', $dados);
    }


    public function formPlacar($id){
        $partida_placar = $this->repository->find($id);
        $partidas = $this->partidaService->todosPorOdemData();
        $clubes = $this->clubeService->todosPorOdemNome();
        $dados = [
            'partida_placar' => $partida_placar,
            'partidas' => $partidas,
            'clubes' => $clubes,
        ];
        return view('partidas.partidas', $dados);
    }


    public function alterarPlacar(Request $request){
        $partida = $this->partidaService->alterarPlacar($request);
        $partidas = $this->partidaService->todosPorOdemData();
        $clubes = $this->clubeService->todos();
        $dados = [
            'partida' => $partida,
            'partidas' => $partidas,
            'clubes' => $clubes
        ];
        // return view('partidas.partidas', $dados);
        return redirect()->route('partidas.index');
    }


}
