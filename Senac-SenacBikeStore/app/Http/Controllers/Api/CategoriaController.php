<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoriaResource;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sortParameter = $request ->input('ordenacao','nome_da_categoria');
        $sortDirection = Str::startsWith($sortParameter,'-') ? 'desc':'asc';
        $sortColumn = ltrim($sortParameter,'-');

        if($sortColumn == 'nome_da_categoria'){
            $categorias = Categoria::orderBy('nomedacategoria', $sortDirection)->get();
        }else{
            $categorias = Categoria::all();
        }



        return response()->json([
            'status'=> 200,
            ' mensagem'=>'Lista de Categorias retornada',
            'categorias' => CategoriaResource::collection($categorias)
        ],200);
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
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = new Categoria();

        $categoria -> nomedacategoria = $request->nome_da_categoria;

        $categoria->save();

        return response() -> json([
            'status' => 200,
            'mensagem'=>'Categoria criada',
            'categoria'=>new CategoriaResource($categoria)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);
        $categoria ->nomedacategoria = $request->nome_da_categoria;
        $categoria->update();

        return response() ->json([
            'status'=>200,
            'mensagem' => 'Categoria Atualizada'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response() ->json([
            'status'=>200,
            'mensagem'=>'Categoria Deletada'
        ],200);
    }
}
