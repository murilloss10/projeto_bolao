<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ApostaCreateRequest;
use App\Http\Requests\ApostaUpdateRequest;
use App\Repositories\ApostaRepository;
use App\service\ApostaService;
use App\service\ClubeService;
use App\service\PartidaService;
use App\Validators\ApostaValidator;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;

/**
 * Class ApostasController.
 *
 * @package namespace App\Http\Controllers;
 */
class ApostasController extends Controller
{
    /**
     * @var ApostaRepository
     */
    protected $repository;

    /**
     * @var ApostaValidator
     */
    protected $validator;


    protected $partidaService;
    protected $clubeService;
    protected $apostaService;


    /**
     * ApostasController constructor.
     *
     * @param ApostaRepository $repository
     * @param ApostaValidator $validator
     */
    public function __construct(ApostaRepository $repository, ApostaValidator $validator, PartidaService $partidaService, ClubeService $clubeService, ApostaService $apostaService)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->partidaService = $partidaService;
        $this->clubeService = $clubeService;
        $this->apostaService = $apostaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $partidas = $this->partidaService->todosPorOdemData();
        $apostas = $this->apostaService->todos();
        $dados = [
            'partidas' => $partidas,
            'apostas' => $apostas
        ];
        return view('apostas.apostas', $dados);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ApostaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ApostaCreateRequest $request)
    {
        try {

            $aposta = $this->apostaService->criar($request);
            $dados = [
                'aposta' => $aposta
            ];

            return redirect()->route('apostas.index', $dados);

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
        $apostum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $apostum,
            ]);
        }

        return view('apostas.show', compact('apostum'));
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
        $apostum = $this->repository->find($id);

        return view('apostas.edit', compact('apostum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ApostaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ApostaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $apostum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Aposta updated.',
                'data'    => $apostum->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
                'message' => 'Aposta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Aposta deleted.');
    }


    public function visualizarAposta($id)
    {
        $aposta = $this->apostaService->buscarPorId($id);
        $partida = $this->partidaService->buscarPorId($aposta->partida_id);
        $dados = [
            'aposta' => $aposta,
            'partida' => $partida
        ];
        return view('apostas.aposta_visualizar', $dados);
    }

    
    public function validarAposta($id)
    {
        $aposta = $this->apostaService->validarAposta($id);
        $dados = [
            'aposta' => $aposta
        ];
        return redirect()->route('apostas.index');
    }


    public function qrCodeLink($id)
    {
        // $request->file('customFileLang1')->storeAs('public', $nameA);
        $img = QRCode::url('http://localhost:8000/aposta/vizualizar/' . $id)->setSize(8)->setMargin(2)->png();
        // Storage::deleteDirectory('app/public/testando', $preserve = false);
        // $img->storeAs('public', 'testes.png');
        // Storage::put('file.jpg', $contents);
        // $content = Storage::disk('images_qrcode')->put('file.txt', 'Teste ', $lock = false);
        // Storage::putFileAs($img, new File('/app/public/storage/qrcode-apostas'), 'photo.png');
        return $img;
    }


    


}
