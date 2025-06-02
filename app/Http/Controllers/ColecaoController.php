<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colecao;

class ColecaoController extends Controller
{
    public function index()
    {
        $colecao = Colecao::all();

        return view('colecao.list', ['colecao' => $colecao]);
    }

    public function create()
    {
        return view('colecao.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_colecao' => 'required|min:3|max:100',
            'descricao' => 'required|min:10',
            'data_lancamento' => 'required|date',
        ]);

        Colecao::create($request->all());

        return redirect()->route('colecao.index');
    }

    public function edit(string $id)
    {
        $colecao = Colecao::findOrFail($id);

        return view('colecao.form', ['colecao' => $colecao]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome_colecao' => 'required|min:3|max:100',
            'descricao' => 'required|min:10',
            'data_lancamento' => 'required|date',
        ]);

        Colecao::updateOrCreate(['id' => $id], $request->all());

        return redirect()->route('colecao.index');
    }

    public function destroy(string $id)
    {
        $colecao = Colecao::findOrFail($id);
        $colecao->delete();

        return redirect()->route('colecao.index');
    }

    public function search(Request $request)
    {
        $colecao = !empty($request->valor)
            ? Colecao::where($request->tipo, 'like', "%$request->valor%")->get()
            : Colecao::all();

        return view('colecao.list', ['colecao' => $colecao]);
    }
}
