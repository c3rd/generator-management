<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Employees/Index', [
            'employees' => Employee::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('first_name', 'like', "%{$search}%");
                    $query->orWhere('last_name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($register) => [
                    'id' => $register->id,
                    'first_name' => $register->first_name,
                    'last_name' => $register->last_name,
                    'birth_date' => $register->toArray()['birth_date'],
                    'monthly_rate' => $register->monthly_rate,
                    'cpf' => $register->cpf,
                    'start_date' => $register->toArray()['start_date'],
                    'end_date' => $register->toArray()['end_date'],
                    'full_name' => $register->full_name,
                ]),
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Employees/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('message', 'Registro adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return Inertia::render('Employees/Show', [
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::find($id, ['id', 'first_name', 'last_name', 'birth_date', 'monthly_rate', 'start_date', 'end_date', 'cpf'])->getRawOriginal();

        return Inertia::render('Employees/Create', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'monthly_rate' => $request->monthly_rate,
            'cpf' => $request->cpf,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('/employees');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
    }
}
