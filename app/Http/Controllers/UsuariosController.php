<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Repositories\UsuarioRepository;
use App\service\UsuarioService;
use App\Validators\UsuarioValidator;


use Illuminate\Support\Facades\Auth;


/**
 * Class UsuariosController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsuariosController extends Controller
{
    /**
     * @var UsuarioRepository
     */
    private $repository;

    /**
     * @var UsuarioValidator
     */
    private $validator;


    private $usuarioService;

    /**
     * UsuariosController constructor.
     *
     * @param UsuarioRepository $repository
     * @param UsuarioValidator $validator
     */
    public function __construct(UsuarioRepository $repository, UsuarioValidator $validator, UsuarioService $usuarioService)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->usuarioService = $usuarioService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idUser = Auth::id();
        $user = $this->usuarioService->perfilUser();
        $usuario = $this->usuarioService->perfilUsuario();
        if (isset($usuario)) {
            $dados = [
                'user_id' => $idUser,
                'usuario_nome' => $user->name,
                'usuario_email' => $user->email,
                'usuario_sobrenome' => $usuario->sobrenome,
                'usuario_cpf' => $usuario->cpf
            ];
        } else {
            $dados = [
                'user_id' => $idUser,
                'usuario_nome' => $user->name,
                'usuario_email' => $user->email,
            ];
        }
        return view('usuarios.usuarios', $dados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UsuarioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UsuarioCreateRequest $request)
    {
        try {

            $usuario = $this->usuarioService->criar($request);
            return redirect()->route('dashboard');

        } catch (ValidatorException $e) {
            //
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Responsex
     */
    public function show($id)
    {
        $user = $this->usuarioService->perfilUserBusca($id);
        $usuario = $this->usuarioService->perfilUsuarioBusca($id);
        $dados = [
            'user' => $user,
            'usuario' => $usuario
        ];
        return view('usuarios.usuarios', $dados);
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
     * @param  UsuarioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function atualizar(UsuarioUpdateRequest $request, $id)
    {
        try {

            $usuario = $this->usuarioService->editar($request, $id);

            $response = [
                'message' => 'Usuário atualizado.',
                'data'    => $usuario->toArray(),
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
                'message' => 'Usuario deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Usuario deleted.');
    }
}
