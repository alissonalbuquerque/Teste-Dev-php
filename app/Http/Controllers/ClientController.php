<?php

namespace App\Http\Controllers;

use App\DTOs\CepDTO;
use App\DTOs\ClientDTO;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Services\SearchCepService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    private ClientRepositoryInterface $clientRepository;

    private SearchCepService $cepApi;

    public function __construct(ClientRepositoryInterface $clientRepository, SearchCepService $cepApi) {
        $this->clientRepository = $clientRepository;
        $this->cepApi = $cepApi;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        /** @var array */
        $data = 
            collect($request->query())
                ->filter(fn($value) => isset($value))
                ->toArray();

        $page = $request->integer('page', 1);

        $perPage = $request->integer('perPage', 10);

        /** @var ClientDTO */
        $clientDTO = new ClientDTO($data);

        /** @var string */
        $cache_key = 'clients';

        $clients = 
            Cache::remember(
                $cache_key, 
                60, 
                function() use ($clientDTO, $page, $perPage) {
                    return $this->clientRepository->findByNameAndCfpAndCep($clientDTO->name, $clientDTO->cpf, $clientDTO->cep, $perPage, $page);
                }
            );

        return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        /** @var array */
        $data = $request->validated();

        try {

            /** @var array */
            $api_response = $this->cepApi->search($data['cep']);

            /** @var CepDTO */
            $cepDTO = new CepDTO($api_response);

                $data['address'] = $cepDTO->address;

            /** @var ClientDTO */
            $clientDTO = new ClientDTO($data);

            /** @var Client */
            $model = $this->clientRepository->create($clientDTO->toArray());

                Cache::forget('clients');

            /** @var ClientResource */
            $resource = new ClientResource($model);

            return $resource->response()->setStatusCode(Response::HTTP_CREATED);

        } catch(Exception $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.error_fetching_api'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            /** @var string */
            $cache_key = "client_{$id}";

           /** @var Client */
            $model =
                Cache::remember(
                    $cache_key, 
                    60, 
                    function () use ($id) {
                        return $this->clientRepository->findById($id);
                    }
                );
            
            /** @var ClientResource */
            $resource = new ClientResource($model);

            return $resource->response()->setStatusCode(Response::HTTP_OK);

        } catch(ModelNotFoundException $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.model_not_found', ['model' => Client::class, 'id' => $id])
            ], Response::HTTP_NOT_FOUND);

        } catch(Exception $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.error_fetching_api'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        /** @var array */
        $data = $request->validated();

        try {

            /** @var array */
            $api_response = $this->cepApi->search($data['cep']);

            /** @var CepDTO */
            $cepDTO = new CepDTO($api_response);

                $data['address'] = $cepDTO->address;

            /** @var ClientDTO */
            $clientDTO = new ClientDTO($data);

            /** @var Client */
            $model = $this->clientRepository->update($id, $clientDTO->toArray());

                Cache::forget("client_{$id}");

            /** @var ClientResource */
            $resource = new ClientResource($model);

            return $resource->response()->setStatusCode(Response::HTTP_OK);

        } catch(ModelNotFoundException $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.model_not_found', ['model' => Client::class, 'id' => $id])
            ], Response::HTTP_NOT_FOUND);

        } catch(Exception $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.error_fetching_api'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            /** @var bool|null */
            $deleted = $this->clientRepository->delete($id);

            if($deleted === null | $deleted === false)
            {
                return response()->json([
                    'message' => __('api.unexpected_error'),
                    'error'   => __('api.model_not_deleted', ['model' => Client::class, 'id' => $id])
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

                Cache::forget("client_{$id}");

            return response()->noContent();

        } catch(ModelNotFoundException $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.model_not_found', ['model' => Client::class, 'id' => $id])
            ], Response::HTTP_NOT_FOUND);

        } catch(Exception $exception) {

            return response()->json([
                'message' => __('api.unexpected_error'),
                'error'   => __('api.error_fetching_api'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
