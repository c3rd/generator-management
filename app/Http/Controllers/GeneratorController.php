<?php

namespace App\Http\Controllers;

use App\Models\Generator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneratorController extends Controller
{
    public function index() {

        $generators = Generator::all();

        return Inertia::render('Generators/Index', [
            'generators' => $generators
        ]);

    }

    public function create() {
        return Inertia::render('Generators/Create');
    }

    public function store(Request $request) {

        $generator = Generator::create($request->all());

        return redirect('/generators');

    }

    public function edit($id) {

        $generator = Generator::find($id);

        return Inertia::render('Generators/Create', [
            'generator' => $generator
        ]);

    }

    public function update(Request $request, $id) {

        $generator = Generator::find($id);

        $generator->update([
            'serial' => $request->serial,
            'brand' => $request->brand,
            'model' => $request->model,
            'hourmeter' => $request->hourmeter
        ]);

        return redirect('/generators');

    }
}
