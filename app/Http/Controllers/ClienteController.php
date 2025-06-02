<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::all();
        return view('cliente.list', ['dados' => $cliente]);
    }

    public function create()
    {
        return view('cliente.form');
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.form', ['dado' => $cliente]);
    }

    private function validateRequest(Request $request, $id = null)
    {
        $uniqueEmail = 'unique:cliente,email';
        if ($id) {
            $uniqueEmail .= ',' . $id;
        }

        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => ['required', 'email', $uniqueEmail],
            'telefone' => 'required|string|max:20',
            'imagem'   => 'nullable|image|max:2048',
        ], [
            'nome.required'     => 'O campo nome é obrigatório',
            'email.required'    => 'O campo email é obrigatório',
            'email.email'       => 'Informe um email válido',
            'email.unique'      => 'Esse email já está em uso',
            'telefone.required' => 'O telefone é obrigatório',
            'imagem.image'      => 'A imagem deve ser um arquivo de imagem',
            'imagem.max'        => 'A imagem deve ter no máximo 2MB',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $data = $request->all();

        // Upload da imagem (se existir)
        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('cliente', 'public');
        }

        Cliente::create($data);

        return redirect('cliente')->with('success', 'Cliente criado com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request, $id);

        $cliente = Cliente::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagem')) {
            if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
                Storage::disk('public')->delete($cliente->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('cliente', 'public');
        }

        $cliente->update($data);

        return redirect('cliente')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
            Storage::disk('public')->delete($cliente->imagem);
        }

        $cliente->delete();

        return redirect('cliente')->with('success', 'Cliente removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $cliente = Cliente::where($request->tipo, 'like', "%{$request->valor}%")->get();
        } else {
            $cliente = Cliente::all();
        }

        return view('cliente.list', ['dados' => $cliente]);
    }
}
