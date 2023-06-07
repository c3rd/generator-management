<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $customers = Customer::all();

        return Inertia::render('Customers/Index', [
            'customers' => Customer::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('first_name', 'like', "%{$search}%");
                    $query->orWhere('last_name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($register) => [
                    'id' => $register->id,
                    'identification_number' => $register->identification_number,
                    'email' => $register->email,
                    'phone_number' => $register->phone_number,
                    'full_name' => $register->full_name,
                ]),
            'filters' => $request->only(['search']),
        ]);

    }

    public function create()
    {
        return Inertia::render('Customers/Create');
    }
}
