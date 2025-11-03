<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class LookupService
{
    public function getAll()
    {
        return [
            'religions' => DB::table('religions')
                ->select('id', 'name')
                ->orderBy('name')
                ->get(),

            'ranks' => DB::table('ranks')
                ->select('id', 'code', 'name')
                ->orderBy('code')
                ->get(),

            'echelons' => DB::table('echelons')
                ->select('id', 'code', 'name')
                ->orderBy('code')
                ->get(),

            'positions' => DB::table('positions')
                ->select('id', 'name')
                ->orderBy('name')
                ->get(),
        ];
    }
}
