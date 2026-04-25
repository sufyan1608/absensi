<?php

namespace App\Http\Controllers\Employee;

use App\Expense;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class ExpenseController extends Controller
{
    public function index () {
        $employee = Auth::user()->employee;

        return view('employee.expenses.index')->with([
            'employee' => $employee,
            'expenses' => $employee->expense
        ]);
    }

    public function create () {
        $departemen = DB::table('departments')
            ->where('id', Employee::find(Auth::user()->employee->id)->department_id)
            ->get();

        $absen = DB::table('attendances')
            ->where('employee_id', Auth::user()->employee->id)
            ->get();

        $out = date('H', strtotime($absen[0]->updated_at));

        if ($out > date('H', strtotime($departemen[0]->overtime_start)) &&
            $out <= date('H', strtotime($departemen[0]->overtime_end))) {

            $jumlah_jam_lembur = $out - date('H', strtotime($departemen[0]->overtime_start));
            $upah_lembur = $departemen[0]->overtime_cost * $jumlah_jam_lembur;

        } else {
            $jumlah_jam_lembur = 0;
            $upah_lembur = "Jam Lembur lewat dari ".$departemen[0]->overtime_start;
        }

        return view('employee.expenses.create')->with([
            'employee' => Auth::user()->employee,
            'jam_absen_out' => $out,
            'jumlah_jam_lembur' => $jumlah_jam_lembur,
            'overtime_cost' => $departemen[0]->overtime_cost,
            'upah_lembur' => $upah_lembur
        ]);
    }

    public function store(Request $request, $employee_id) {

        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'receipt' => 'image|nullable'
        ]);

        $filename_store = null;

        // ✅ FIX UPLOAD RECEIPT
        if ($request->hasFile('receipt')) {

            $image = $request->file('receipt');

            // nama aman
            $filename_store = 'receipt_' . time() . '.' . $image->getClientOriginalExtension();

            // resize
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);

            // path benar
            $folder = storage_path('app/public/receipts');

            // buat folder jika belum ada
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // simpan (FIX UTAMA)
            $image_resize->save($folder . '/' . $filename_store);
        }

        Expense::create([
            'employee_id' => $employee_id,
            'reason' => $request->reason,
            'description' => $request->description,
            'amount' => $request->amount,
            'receipt' => $filename_store
        ]);

        $request->session()->flash('success', 'Pengajuan Lembur Berhasil Dikirim');
        return redirect()->route('employee.expenses.create');
    }

    public function edit($expense_id) {
        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);

        return view('employee.expenses.edit')->with('expense', $expense);
    }

    public function update(Request $request, $expense_id) {

        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);

        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'receipt' => 'image|nullable'
        ]);

        $expense->reason = $request->reason;
        $expense->description = $request->description;
        $expense->amount = $request->amount;

        if ($request->hasFile('receipt')) {

            // hapus file lama
            if ($expense->receipt) {
                $old_path = storage_path('app/public/receipts/' . $expense->receipt);
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }

            $image = $request->file('receipt');
            $filename_store = 'receipt_' . time() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);

            $folder = storage_path('app/public/receipts');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $image_resize->save($folder . '/' . $filename_store);

            $expense->receipt = $filename_store;
        }

        $expense->save();

        $request->session()->flash('success', 'Data berhasil diupdate');
        return redirect()->route('employee.expenses.index');
    }

    public function destroy($expense_id) {

        $expense = Expense::findOrFail($expense_id);
        Gate::authorize('employee-expenses-access', $expense);

        if ($expense->receipt) {
            $filepath = storage_path('app/public/receipts/' . $expense->receipt);
            if (file_exists($filepath)) {
                unlink($filepath);
            }
        }

        $expense->delete();

        request()->session()->flash('success', 'Data berhasil dihapus');
        return redirect()->route('employee.expenses.index');
    }
}