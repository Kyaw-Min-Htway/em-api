<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;;

class EmployeeController extends Controller
{
    public function index()
    {
        return Employee::all();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|string',
        ]);

        $employee = Employee::create($request->all());

        return response()->json($employee, 201);
    }

    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();
        return response()->json($employee, 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::where('id', $id)->first();


        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email,' . $id,
            'position' => 'sometimes|required|string|max:255',
        ]);

        $employee->update($validatedData);
        return response()->json($employee, 200);
    }

    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();
        return response()->json([
            "status" => "ok",
            "message" => "Delete sussessfully. "
        ], 204);
    }
}
