<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employees;
use App\Services\EmployeesService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeesController extends Controller
{
    protected $svc;

    public function __construct(EmployeesService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $req)
    {
        return response()->json($this->svc->list($req));
    }

    public function store(StoreEmployeeRequest $req)
    {
        $Employees = $this->svc->create($req->validated());
        return response()->json([
            'message' => 'Sukses menambahkan data',
            'data' => $Employees
        ]);
    }

    public function show(Employees $Employees)
    {
        $Employees->load(['unit', 'religion', 'rank', 'echelon', 'position']);
        return response()->json($Employees);
    }

    public function update(UpdateEmployeeRequest $req, Employees $Employees)
    {
        $updated = $this->svc->update($Employees, $req->validated());
        return response()->json([
            'message' => 'Sukses mengubah data',
            'data' => $updated
        ]);
    }

    public function destroy(Employees $Employees)
    {
        $this->svc->delete($Employees);
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function uploadPhoto(Request $req, Employees $Employees)
    {
        $req->validate(['photo' => 'required|image|max:2048']);
        $url = $this->svc->uploadPhoto($Employees, $req->file('photo'));
        return response()->json(['photo_url' => $url]);
    }
}
