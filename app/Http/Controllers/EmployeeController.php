<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\DocumentType;
use App\Models\Role;
use Dom\DocumentType as DomDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $recordsPerPage = $request->records_per_page ?? env('PAGINATION_DEFAULT_SIZE');
        $recordsPerPage = min($recordsPerPage, env('PAGINATION_MAX_SIZE'));

        $employees = Employee::with(['documentType', 'role', 'jefe'])
            ->where('nombre', 'LIKE', "%{$request->filter}%")
            ->paginate($recordsPerPage);

        return view('employee.index', ['employees' => $employees, 'data' => $request]);
    }

    public function create()
    {
        $documentTypes = DocumentType::all();
        $roles = Role::all();
        $employees = Employee::all(); // Para seleccionar el jefe
        return view('employee.create', compact('documentTypes', 'roles', 'employees'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|integer|min:0',
            'tipo_doc_id' => 'required|exists:document_type,type_doc_id', // Asegúrate de usar 'type_doc_id'
            'cargo_id' => 'required|exists:roles,id',
            'jefe_id' => 'nullable|exists:employee,Empleado_ID',
            'activo' => 'required|boolean',
            'bit_usuario' => 'required|boolean',
        ])->validate();

        try {
            $employee = new Employee();
            $employee->fill($request->all());
            $employee->save();

            Session::flash('message', ['content' => 'Employee created successfully.', 'type' => 'success']);
            return redirect()->route('employee.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            Session::flash('message', ['content' => "Employee with id: '$id' not found.", 'type' => 'error']);
            return redirect()->back();
        }

        $documentTypes = DocumentType::all();
        $roles = Role::all();
        $employees = Employee::all(); // Para seleccionar el jefe
        return view('employee.edit', compact('employee', 'documentTypes', 'roles', 'employees'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'Empleado_ID' => 'required|exists:employee,Empleado_ID',
            'nombre' => 'required|string|max:100',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|integer|min:0',
            'tipo_doc_id' => 'required|exists:document_type,type_doc_id', // Asegúrate de usar 'type_doc_id'
            'cargo_id' => 'required|exists:roles,id',
            'jefe_id' => 'nullable|exists:employee,Empleado_ID',
            'activo' => 'required|boolean',
            'bit_usuario' => 'required|boolean',
        ])->validate();

        try {
            $employee = Employee::find($request->Empleado_ID);
            $employee->fill($request->all());
            $employee->save();

            Session::flash('message', ['content' => 'Employee updated successfully.', 'type' => 'success']);
            return redirect()->route('employee.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee) {
                Session::flash('message', ['content' => "Employee with id: '$id' not found.", 'type' => 'error']);
                return redirect()->back();
            }

            $employee->delete();

            Session::flash('message', ['content' => 'Employee deleted successfully.', 'type' => 'success']);
            return redirect()->route('employee.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
