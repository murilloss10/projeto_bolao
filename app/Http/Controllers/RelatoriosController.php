<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RelatorioCreateRequest;
use App\Http\Requests\RelatorioUpdateRequest;
use App\Repositories\RelatorioRepository;
use App\Validators\RelatorioValidator;

/**
 * Class RelatoriosController.
 *
 * @package namespace App\Http\Controllers;
 */
class RelatoriosController extends Controller
{
    /**
     * @var RelatorioRepository
     */
    protected $repository;

    /**
     * @var RelatorioValidator
     */
    protected $validator;

    /**
     * RelatoriosController constructor.
     *
     * @param RelatorioRepository $repository
     * @param RelatorioValidator $validator
     */
    public function __construct(RelatorioRepository $repository, RelatorioValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $relatorios = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $relatorios,
            ]);
        }

        return view('relatorios.index', compact('relatorios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RelatorioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RelatorioCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $relatorio = $this->repository->create($request->all());

            $response = [
                'message' => 'Relatorio created.',
                'data'    => $relatorio->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relatorio = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $relatorio,
            ]);
        }

        return view('relatorios.show', compact('relatorio'));
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
        $relatorio = $this->repository->find($id);

        return view('relatorios.edit', compact('relatorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RelatorioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RelatorioUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $relatorio = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Relatorio updated.',
                'data'    => $relatorio->toArray(),
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
                'message' => 'Relatorio deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Relatorio deleted.');
    }
}
