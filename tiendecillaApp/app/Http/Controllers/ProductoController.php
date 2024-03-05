<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductoController extends Controller {

    public function index() {
        $productos = Producto::all();
        return view('producto.index', ['productos' => $productos]);
    }

    public function create() {
        return view('producto.create');
    }

    public function store(Request $request) {
        $productos = new Producto($request->all());
        try {
            if($request->hasFile('cover') && $request->file('cover')->isValid()) {
                $archivo = $request->file('cover');
                $path = $archivo->storeAs('public/images', $archivo->getClientOriginalName());
                $mime = $archivo->getMimeType();
                $path = $archivo->getRealPath();
                $imagen = Image::make($path)->resize(245, 245, function($constraint) {
                    $constraint->aspectRatio();
                });
                $canvas = Image::canvas(245, 245);
                $canvas->insert($imagen, 'center');
                $canvas->save($path);
                $imagen = file_get_contents($path);
                $productos->cover = base64_encode($imagen);
            }
            $productos->save();
            $target = 'producto';
            return redirect($target)->with(['message'=> 'El producto se ha guardado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message'=> 'El producto no se ha guardado correctamente']);
        }
    }

    public function show(Producto $producto) {
        return view('producto.show', ['producto' => $producto]);
    }

    public function edit(Producto $producto) {
        return view('producto.edit', ['producto' => $producto]);
    }

   public function update(Request $request, Producto $producto) {
       $producto->update($request->all());
        try {
            if ($image = $request->file('cover')) {
    
                $destinationPath = 'public/images';
    
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    
                $image->move($destinationPath, $profileImage);
    
                $input['cover'] = "$profileImage";
    
            }else{
    
                unset($input['cover']);
    
            }
            return redirect('producto')->with(['message'=>'El producto se ha actualizado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El producto no se ha actualizado correctamente']);
        }
    }

    public function destroy(Producto $producto) {
        try {
            $producto->delete();
            return redirect('producto')->with(['message' => 'El producto se ha borrado correctamente']);
        } catch(\Exception $e) {
            return back()->withErrors(['message' => 'El producto no se ha borrado correctamente']);
        }
    }
}
