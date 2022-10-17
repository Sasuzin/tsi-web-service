<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;
use App\Http\Requests\StoreProdutoRequest;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->input('pagina');

        $query = Produto::with('categoria');
        if($input){
            $page = $input;
            $perPage = 10;
            $query->offset(($page-1)* $perPage)->limit($perPage);
            $produtos = $query->get();

            $recordsTotal = Produto::count();
            $numberOfPages = ceil($recordsTotal/ $perPage);
            $response = response() -> json([
                'status'=>200,
                'mensagem'=>'Lista de Produtos retornada',
                'produtos'=>ProdutoResource::collection($produtos),
                'meta'=>[
                    'total_numero_de_registros'=>(string) $recordsTotal,
                    'numero_de_registros_por_pagina'=>(string) $perPage,
                    'numero_de_paginas' => (string) $numberOfPages,
                    'pagina_atual' => $page
                ]
                ],200);
        }else{
            $produtos = $query->get();

            $response = response()->json([
                'status' => 200,
                'mensagem'=> 'Lista de Produtos Retornada',
                'produtos'=> ProdutoResource::collection($produtos) ,
            ],200);
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
