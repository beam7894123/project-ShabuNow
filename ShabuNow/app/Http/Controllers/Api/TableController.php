<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        return Table::get();
    }

    public function count()
    {
        return Table::count();
    }

    public function show(Table $table)
    {
        return $table;
    }

    public function update(Request $request, Table $table)
    {
        $table->status = $request->get('status');
        $table->save();
        return $table;
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return Table::get();
    }

}
