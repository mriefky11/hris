<?php

namespace App\Http\Controllers;

use App\Http\Requests\Leave\StoreRequest;
use App\Services\LeaveService;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public LeaveService $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    public function index()
    {
        $leaves = $this->leaveService->allForUser(auth()->user());

        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(StoreRequest $request)
    {
        $this->leaveService->create(
            $request->validated(),
            auth()->user()->employee->id
        );

        return redirect()->route('leaves.index')
            ->with('success', 'Pengajuan cuti berhasil diajukan.');
    }

    public function show($id)
    {
        $leave = $this->leaveService->findById($id);

        if (! $this->leaveService->canAccess(auth()->user(), $leave)) {
            abort(403);
        }

        return view('leaves.show', compact('leave'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $leave = $this->leaveService->findById($id);

        if ($leave->status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan cuti sudah diproses.');
        }

        $this->leaveService->updateStatus($leave, $request->status, auth()->id());

        return redirect()->back()->with('success', 'Status pengajuan cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $leave = $this->leaveService->findById($id);

        if (! auth()->user()->isAdmin() && auth()->user()->employee?->id !== $leave->employee_id) {
            abort(403);
        }

        if ($leave->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya pengajuan pending yang dapat dihapus.');
        }

        $this->leaveService->destroy($id);

        return redirect()->route('leaves.index')
            ->with('success', 'Pengajuan cuti berhasil dihapus.');
    }
}
