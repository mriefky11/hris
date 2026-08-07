<?php

namespace App\Http\Controllers;

use App\Http\Requests\Overtime\StoreRequest;
use App\Services\OvertimeService;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public OvertimeService $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->overtimeService = $overtimeService;
    }

    public function index()
    {
        $overtimes = $this->overtimeService->allForUser(auth()->user());

        return view('overtimes.index', compact('overtimes'));
    }

    public function create()
    {
        return view('overtimes.create');
    }

    public function store(StoreRequest $request)
    {
        $this->overtimeService->create(
            $request->validated(),
            auth()->user()->employee->id
        );

        return redirect()->route('overtimes.index')
            ->with('success', 'Pengajuan lembur berhasil diajukan.');
    }

    public function show($id)
    {
        $overtime = $this->overtimeService->findById($id);

        if (! $this->overtimeService->canAccess(auth()->user(), $overtime)) {
            abort(403);
        }

        return view('overtimes.show', compact('overtime'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $overtime = $this->overtimeService->findById($id);

        if ($overtime->status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan lembur sudah diproses.');
        }

        $this->overtimeService->updateStatus($overtime, $request->status, auth()->id());

        return redirect()->back()->with('success', 'Status pengajuan lembur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $overtime = $this->overtimeService->findById($id);

        if (! auth()->user()->isAdmin() && auth()->user()->employee?->id !== $overtime->employee_id) {
            abort(403);
        }

        if ($overtime->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya pengajuan pending yang dapat dihapus.');
        }

        $this->overtimeService->destroy($id);

        return redirect()->route('overtimes.index')
            ->with('success', 'Pengajuan lembur berhasil dihapus.');
    }
}
