<?php

namespace App\Services;

use App\Models\Employees;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeesService
{
    public function list(Request $req)
    {
        $query = Employees::with(['unit', 'religion', 'rank', 'echelon', 'position'])
            ->when($req->search, function ($q) use ($req) {
                $s = "%{$req->search}%";
                $q->where('full_name', 'like', $s)
                    ->orWhere('nip', 'like', $s);
            })
            ->when($req->unit_id, function ($q) use ($req) {
                $q->where('unit_id', $req->unit_id);
            })
            ->orderBy($req->get('sort', 'full_name'), $req->get('dir', 'asc'));

        return $query->paginate($req->get('per_page', 10));
    }

    public function create(array $data)
    {
        $data['id'] = (string) Str::ulid();
        return Employees::create($data);
    }

    public function update(Employees $Employees, array $data)
    {
        $Employees->update($data);
        return $Employees;
    }

    public function delete(Employees $Employees)
    {
        if ($Employees->photo_path) {
            Storage::disk('public')->delete($Employees->photo_path);
        }
        $Employees->delete();
    }

    public function uploadPhoto(Employees $Employees, $file)
    {
        $filename = 'emp_' . $Employees->id . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('photos', $filename, 'public');
        $Employees->update(['photo_path' => $path]);
        return asset('storage/' . $path);
    }
}
