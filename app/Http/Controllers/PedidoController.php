<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedidoController extends Controller
{

    public function index()
    {
        return Inertia::render('Pedidos/Index',[
            'pedidos' => Pedido::paginate(10)
        ]);
    }

   
    public function create()
    {
       return Inertia::render('Pedidos/Create',[
        'clientes' => Cliente::all(),
       ]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
        'isbn' =>'required|max:13',
        'title' =>'required|max:100',
         'Fecha_Pedido_date' =>'required|date',
          'Fecha_Envio_date' =>'required|date',
           'Metodo_Pago' =>'required|max:13',
            'description' =>'required|max:200',
             'total' =>'required|numeric',
             'image' =>'required|file|mimes:png,jpg,gif',
             'clientes' =>'required|array'
        ]);
        $pedido = Pedido::create($request->all());
        if($request->hasFile('image')){
            $imgName = microtime(true).'.'.$request->file('image')
            ->getClientOriginalExtension();
            $request->file('image')->storeAs('public/img/',$imgName);
            $pedido->image = '/img/'.$imgName;
            $pedido->save();
        }
        $pedido->clientes()->sync($request->clientes);
        return redirect ('pedidos/create')->with('success','Pedido created');
    }
    public function updatePedido(Request $request){
        $request->validate([
            'isbn' =>'required|max:13',
            'title' =>'required|max:100',
            'Fecha_Pedido' =>'required|date',
            'Fecha_Envio' =>'required|date',
            'Metodo_Pago' =>'required|max:13',
                'description' =>'required|max:200',
                'total' =>'required|numeric',
                'id' =>'required|numeric',
                'clientes' =>'required|array'
            ]);
            $pedido = Pedido::find($request->id);
            $pedido->update($request->input());
            if($request->hasFile('image')){
                Storage::disk('public')->delete($pedido->image);
                $imgName = microtime(true).'.'.$request->file('image')
                ->getClientOriginalExtension();
                $request->file('image')->storeAs('public/img/',$imgName);
                $pedido->image = '/img/'.$imgName;
                $pedido->save();
            }
            $pedido->clientes()->sync($request->clientes);
            return redirect ('pedidos')->with('success','Pedido updated');
    }
    public function show(Pedido $pedido)
    {
        return inertia::render('Pedidos/Show',[
        'pedido' => $pedido,'clientes' => $pedido->clientes
        ]);
    }

    
    public function edit(Pedido $pedido)
    {
        return Inertia::render('Pedidos/Edit',[
            'clientes' => Cliente::all(),
            'pedido' => $pedido,
            'clientesOfPedido' =>$pedido->clientes
        ]);
    }

    
    public function update(Request $request, Pedido $pedido)
    {
        
    }

    
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect('pedidos')->with('success','Pedido deleted');
    }
}
