<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __construct()
{
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
}

    public function index()
    {
        return view('dashboard.index');
    }

    public function data(Request $request)
    {
        $query = Registration::query();

        // =============== SEARCH ===============
        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        // =============== SORTING ===============
        $sortColumn = $request->sort_column ?? 'id';
        $sortDirection = $request->sort_direction ?? 'asc';

        $dbColumns = Schema::getColumnListing('registrations');
        $extra = ['photo_url', 'is_paid', 'is_payment_link_active'];
        $allowedSort = array_merge($dbColumns, $extra);

        if (!in_array($sortColumn, $allowedSort)) {
            $sortColumn = 'id';
        }

        // Sorting for appended attributes
        if (in_array($sortColumn, $extra)) {
            $data = $query->get()->sortBy($sortColumn, SORT_REGULAR, $sortDirection === 'desc')->values();
            return response()->json([
                'data' => $data->forPage($request->page, 10)->values(),
                'current_page' => (int) $request->page,
                'last_page' => ceil($data->count() / 10)
            ]);
        }

        // Sorting for database columns
        $query->orderBy($sortColumn, $sortDirection);

        // =============== PAGINATION ===============
        $data = $query->paginate(10);

        // Add appended attributes
        $data->getCollection()->transform(fn($item) => $item->toArray());

        return response()->json($data);
    }
}
