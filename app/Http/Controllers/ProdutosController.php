<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    /**C - CREATE
     * R - READ
     * U - UPDATE
     * D - DELETE
    */

    // READ - LER
    public function index() {
        $produtos = Produto::where('ativo', 1)->get();

        return response()->json([
            "produtos" =>  $produtos
        ]);
    }

    // READ - LER
    public function getProduto($id) {
        $produto = Produto::where('id', $id)->first();

        if(!$produto) {
            return response()->json([
                "mensagem" =>  "prduto não encontrado"
            ], 404);
        }

        return response()->json([
            "produto" =>  $produto
        ]);
    }

    // CREATE - CRIAR
    public function store(Request $request) {

        $produto = new Produto();

        $produto->nome = $request->nome;
        $produto->categoria = $request->categoria;
        $produto->preco = $request->preco;

        $produto->save();

        return response()->json([
            "produto" =>  $produto
        ]);
    }

    // UPDATE - ATUALIZAR
    public function update(Request $request, $id) {
        $produto = Produto::where('id', $id)->first();

        $produto->nome = $request->nome;
        $produto->categoria = $request->categoria;
        $produto->preco = $request->preco;

        $produto->save();

        return response()->json([
            "mensagem" => "produto alterado com sucesso",
            "produto" =>  $produto
        ]);
    }

    // DELETE
    public function delete($id) {
        $produto = Produto::where('id', $id)->first();

        if(!$produto) {
            return response()->json([
                "mensagem" =>  "produto não encontrado"
            ], 404);
        }

        $produto->ativo = 0;
        $produto->save();

        return response()->json([
            "mensagem" => "produto deletado com sucesso"
        ]);
    }

}
