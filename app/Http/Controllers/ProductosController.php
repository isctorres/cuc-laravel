<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;

class ProductosController extends Controller
{

    public function index(){
        $productos = Productos::all();
        return view('admin.productos.index',compact('productos'));
    }

    // Visualizar la pantalla de crear producto
    public function crear(){
        $productos = Productos::all();
        return view('admin.productos.crear',compact('productos'));
    }


    public function store(ItemCreateRequest $request){
        $productos = new Productos;
        $productos->nombre = $request->nombre;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;
        $productos->img = $request->file('img')->store('/');
        $productos->created_at = (new DateTime)->getTimestamp();
        $productos->save();

        return redirect('admin/productos')->with('message','Producto guardado correctamente');
    }

    public function show($id){
        $productos = Productos::find($id);
        return view('admin.productos.detalles',compact('productos'));
    }

    public function actualizar($id){
        $productos = Productos::find($id);
        return view('admin.productos.actualizar',['productos'=>$productos]);
    }

    public function update(ItemUpdateRequest $request, $id){
        $productos = Productos::find($id);
        $productos->nombre = $request->nombre;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;

        if( $request->hasFile('img')){
            $productos->img = $request->file('img')->store('/');
        }

        $productos->updated_at = (new DateTime)->getTimestamp();
        $productos->save();
        Session::flash('message','Producto actualizado correctamente');
        return Redirect::to('admin/productos');
    }

    public function eliminar($id){
        $productos->Productos::find($id);

        // Eliminamos el archivo de imagen dentro del servidor
        $imagen = explode(",", $productos->img);
        Storage::delete($imagen);
        // eliminamos el producto de la base de datos
        Productos::destroy($id);
        Session::flash('message','Producto eliminado correctamente');
        return Redirect::to('admin/productos');
    }
}
