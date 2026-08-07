<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payroll\StoreRequest;
use App\Http\Requests\Payroll\UpdateRequest;
use App\Services\EmployeeService;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    public PayrollService $payrollService;
    public EmployeeService $employeeService;

    public function __construct(PayrollService $payrollService, EmployeeService $employeeService)
    {
        $this->payrollService = $payrollService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $payrolls = $this->payrollService->allForUser(auth()->user());

        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = $this->employeeService->all();

        return view('payrolls.create', compact('employees'));
    }

    public function store(StoreRequest $request)
    {
        $this->payrollService->create($request->validated());

        return redirect()->route('payrolls.index')
            ->with('success', 'Data payroll berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payroll = $this->payrollService->findById($id);

        if (! $this->payrollService->canAccess(auth()->user(), $payroll)) {
            abort(403);
        }

        return view('payrolls.show', compact('payroll'));
    }

    public function edit($id)
    {
        $payroll = $this->payrollService->findById($id);
        $employees = $this->employeeService->all();

        return view('payrolls.create', compact('payroll', 'employees'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->payrollService->update($request->validated(), $id);

        return redirect()->route('payrolls.index')
            ->with('success', 'Data payroll berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->payrollService->destroy($id);

        return redirect()->route('payrolls.index')
            ->with('success', 'Data payroll berhasil dihapus.');
    }
}
