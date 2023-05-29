<?php

namespace App\Http\Controllers;

use App\Models\Generator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneratorController extends Controller
{
    public function index(Request $request)
    {

        return Inertia::render('Generators/Index', [
            'generators' => Generator::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('serial', 'like', "%{$search}%");
                    $query->orWhere('brand', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'serial' => $user->serial,
                    'model' => $user->model,
                    'brand' => $user->brand,
                    'hourmeter' => $user->hourmeter,
                ]),
            'filters' => $request->input('search'),
        ]);
    }

    public function show($id)
    {
    }

    public function create()
    {
        return Inertia::render('Generators/Create');
    }

    public function store(Request $request)
    {

        $generator = Generator::create($request->all());

        return redirect('/generators');
    }

    public function edit($id)
    {

        $generator = Generator::find($id);

        return Inertia::render('Generators/Create', [
            'generator' => $generator
        ]);
    }

    public function update(Request $request, $id)
    {

        $generator = Generator::find($id);

        $generator->update([
            'serial' => $request->serial,
            'brand' => $request->brand,
            'model' => $request->model,
            'hourmeter' => $request->hourmeter
        ]);

        return redirect('/generators');
    }

    public function destroy($id)
    {

        $generator = Generator::find($id)->delete();
    }
}
