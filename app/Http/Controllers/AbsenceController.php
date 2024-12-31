<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Employee;
use App\Models\Division;
use App\Models\Shift;
use App\Http\Controllers\EmpolyeeController;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['employee', 'division', 'shift'])
        ->orderBy('created_at', 'desc')
        ->get();
        return view('absence.index', compact('absences'));
    }

    public function create()
    {
        $employees = Employee::all();
        $divisions = Division::all();
        $shifts = Shift::all();
        $attendances = ['present', 'sick', 'vacation', 'alpha'];
        $islates = ['On Time', 'Late'];
        return view('absence.create', compact('employees', 'divisions', 'shifts', 'attendances', 'islates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'date' => 'required|date',
            // 'time' => 'required|date_format:H:i:s',
            'attendance' => 'required',
            // 'is_late' => 'required|boolean',
            // 'last_division' => 'required',
            'current_division' => 'required|exists:divisions,id',
            'id_employee' => 'required|exists:employees,id',
            'shift_id' => 'required|exists:shifts,id',
        ]);

        //ambil waktu dulu
        $current_time = date('H:i:s');

        //mengambil current divisi dari tabel divisi
        $last_division = Absence::where('id_employee', $request->id_employee)->orderBy('created_at', 'desc')->first();

        //cek apabila null atau pertama kali
        if ($last_division == null) {
            //buat agar dia tetap menjadi objek
            $last_division = (object) ['current_division' => $request->current_division];
        }
        //ambil waktu shift
        $shift = Shift::find($request->shift_id);

        //menghitung waktu shift dengan waktu sekarang
        $diff = strtotime($current_time) - strtotime($shift->time);
        if($diff > 0){
            $is_late = true;

        }else{
            $is_late = false;
        }

        //create data
        Absence::create([
            'attendance' => $request->attendance,
            'is_late' => $is_late,
            'last_division' => $last_division->current_division,
            'current_division' => $request->current_division,
            'id_employee' => $request->id_employee,
            'shift_id' => $request->shift_id,
        ]);

        // Absence::create(attributes: $request->all());
        return redirect()->route('absence.index')->with('success', 'Absence created successfully.');
    }

    public function show($id)
    {
        $absences = Absence::with('employee', 'division', 'shift')->find($id);
        return view('absence.show', compact('absences', 'employees', 'divisions', 'shifts', 'attendances', 'islates'));
    }

    public function edit($id)
    {
        $absences = Absence::find($id);
        $employees = Employee::all();
        $divisions = Division::all();
        $shifts = Shift::all();
        $attendances = ['present', 'sick', 'vacation', 'alpha'];
        $islates = ['On Time', 'Late'];
        return view('absence.edit', compact('absences', 'employees', 'divisions', 'shifts', 'attendances', 'islates'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
            'attendance' => 'required|boolean',
            'is_late' => 'required|boolean',
            'last_division' => 'required',
            'current_division' => 'required',
            'id_employee' => 'required|integer',
            'shift_id' => 'required|integer',
        ]);

        $absences = Absence::find($id);
        $absences->update($request->all());

        return redirect()->route('absence.index')->with('success', 'Absence updated successfully.');
    }

    public function destroy($id)
    {
        $absences = Absence::find($id);
        $absences->delete();

        return redirect()->route('absence.index')->with('success', 'Absence deleted successfully.');
    }
}
