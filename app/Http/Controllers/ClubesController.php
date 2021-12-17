<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClubeCreateRequest;
use App\Http\Requests\ClubeUpdateRequest;
use App\Repositories\ClubeRepository;
use App\Validators\ClubeValidator;
use App\service\ClubeService;

/**
 * Class ClubesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClubesController extends Controller
{
    /**
     * @var ClubeRepository
     */
    protected $repository;

    /**
     * @var ClubeValidator
     */
    protected $validator;

    /**
     * @var ClubeService
     */
    protected $clubeService;

    /**
     * ClubesController constructor.
     *
     * @param ClubeRepository $repository
     * @param ClubeValidator $validator
     */
    public function __construct(ClubeRepository $repository, ClubeValidator $validator, ClubeService $clubeService)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->clubeService = $clubeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = NULL)
    {
        if ($id == NULL) {
            $clube = NULL;
        } else {
            $clube = $this->clubeService->buscarPorId($id);
        }
        $clubes = $this->clubeService->todosComApagados();
        $dados = [
            'clubes' => $clubes,
            'clube' => $clube
        ];
        return view('clubes.clubes', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClubeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClubeCreateRequest $request)
    {
        try {

            $clube = $this->clubeService->criar($request);
            $message_ = 'O clube foi adicionado.';
            // $dados = [
            //     'message_' => 'O clube foi adicionado.',
            //     'clube'    => $clube,
            // ];
            // return redirect()->back()->with('message', $response['message']);
            return redirect()->route('clubes.index', $message_);

        } catch (ValidatorException $e) {
            
            $dados = [
                'message_' => 'Erro ao adicionar o clube'
            ];
            return redirect()->back()->with('message_', $dados);

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
     * @param  ClubeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClubeUpdateRequest $request)
    {
        try {

            $clube = $this->clubeService->editar($request);
            return redirect()->route('clubes.index');

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
        $deleted = $this->clubeService->apagar($id);
        return redirect()->route('clubes.index');
    }


    public function restaurar($id){
        $clube = $this->clubeService->restaurarClubeApagado($id);
        return redirect()->route('clubes.index');
    }

}
