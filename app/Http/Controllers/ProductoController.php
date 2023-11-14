<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
  public function index(Request $request)
  {
    $productos = Producto::where('nombre', 'like', '%' . $request->search . '%')->get();
    return $productos;
  }

  public function store(Request $request)
  {

    $producto = new Producto();
    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->stock = $request->stock;
    $producto->categoria = $request->categoria;
    $producto->puntuacion = $request->puntuacion;
    $producto->miniatura = $request->miniatura;
    $producto->save();

    $imgs = array_map(function ($img) use ($producto) {
      return [
        'producto_id' => $producto->id,
        'url' => $img
      ];
    }, $request->imagenes);
    ImagenProducto::insert($imgs);

    return [
      'data' => [
        $producto
      ]
    ];
  }

  public function show($id)
  {
    $producto = Producto::find($id);
    $producto->imagenes;
    return $producto;
  }

  public function update(Request $request, $id)
  {
    $producto = Producto::find($id);
    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->stock = $request->stock;
    $producto->categoria = $request->categoria;
    $producto->puntuacion = $request->puntuacion;
    $producto->miniatura = $request->miniatura;
    $producto->imagenes()->delete();
    $producto->save();

    $imgs = array_map(function ($img) use ($producto) {
      return [
        'producto_id' => $producto->id,
        'url' => $img
      ];
    }, $request->imagenes);
    ImagenProducto::insert($imgs);

    return [
      'data' => [
        $producto
      ]
    ];
  }
}
