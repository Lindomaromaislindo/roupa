<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Colecao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $dados = Produto::with('colecao')->get();
        return view('produto.list', ['dados' => $dados]);
    }

    public function create()
    {
        $colecoes = Colecao::orderBy('nome_colecao')->get();
        return view('produto.form', ['colecoes' => $colecoes]);
    }

    public function edit(string $id)
    {
        $dado = Produto::findOrFail($id);
        $colecoes = Colecao::orderBy('nome_colecao')->get();

        return view('produto.form', [
            'dado' => $dado,
            'colecoes' => $colecoes,
        ]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome'        => 'required|string|max:255',
            'descricao'   => 'nullable|string',
            'preco'       => 'required|numeric|min:0',
            'colecao_id'  => 'required|exists:colecoes,id',
            'imagem'      => 'nullable|image|max:2048',
        ], [
            'nome.required'       => 'O campo nome é obrigatório',
            'preco.required'      => 'O campo preço é obrigatório',
            'preco.numeric'       => 'O preço deve ser um número',
            'colecao_id.required' => 'A coleção é obrigatória',
            'imagem.image'        => 'O arquivo deve ser uma imagem',
            'imagem.max'          => 'A imagem deve ter no máximo 2MB',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('produto', 'public');
        }

        Produto::create($data);

        return redirect('produto')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $produto = Produto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($produto->imagem && Storage::disk('public')->exists($produto->imagem)) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $data['imagem'] = $request->file('imagem')->store('produto', 'public');
        }

        $produto->update($data);

        return redirect('produto')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $produto = Produto::findOrFail($id);

        if ($produto->imagem && Storage::disk('public')->exists($produto->imagem)) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect('produto')->with('success', 'Produto removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Produto::where($request->tipo, 'like', "%{$request->valor}%")->get();
        } else {
            $dados = Produto::with('colecao')->get();
        }

        return view('produto.list', ['dados' => $dados]);
    }
}
