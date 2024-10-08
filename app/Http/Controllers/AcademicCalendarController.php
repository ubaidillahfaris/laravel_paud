<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AcademicCalendarController extends Controller
{
    public function index()
    {
        $events = AcademicCalendar::orderBy('event_date', 'asc')->get();
        return Inertia::render('AcademicCalendar/Index', [
            'events' => $events
        ]);
    }

    public function create()
    {
        return Inertia::render('AcademicCalendar/Create');
    }


    public function show(Request $request)
    {

        // Ambil parameter 'page' dari request atau default ke halaman 1 jika tidak ada
        $currentPage = $request->input('page', 1);

        $monthEvents = AcademicCalendar::query()
            ->select(
                DB::raw("date_part('month', event_date) as month"),
                DB::raw("date_part('year', event_date) as year"),
                DB::raw("count(id) as total")
            )
            ->groupByRaw("date_part('year', event_date)")
            ->groupByRaw("date_part('month', event_date)")
            ->orderBy("year", 'DESC')
            ->orderBy("month", 'DESC')
            ->paginate();

        // Transformasi data untuk menambahkan detail dari setiap group
        $transformedData = $monthEvents->map(function ($item) {
            // Ambil semua event untuk bulan dan tahun tertentu
            $events = AcademicCalendar::whereYear('event_date', $item->year)
                ->whereMonth('event_date', $item->month)
                ->orderBy('event_date', 'asc')
                ->get();

            // Format data menjadi struktur yang diinginkan
            return [
                'date' => $item->year.'-'.sprintf('%02d', $item->month),
                'month' => $item->month,
                'total' => $item->total,
                'events' => $events->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->title,
                        'description' => $event->description,
                        'event_date' => $event->event_date,
                        'tahun_pelajaran_id' => $event->tahun_pelajaran_id,
                        'semester' => $event->semester,
                    ];
                }),
            ];
        })->toArray();


        $paginatedData = [
            'current_page' => $monthEvents->currentPage(),
            'data' => $transformedData,
            'first_page_url' => $monthEvents->url(1),
            'from' => $monthEvents->firstItem(),
            'last_page' => $monthEvents->lastPage(),
            'last_page_url' => $monthEvents->url($monthEvents->lastPage()),
            'next_page_url' => $monthEvents->nextPageUrl(),
            'path' => $monthEvents->path(),
            'per_page' => $monthEvents->perPage(),
            'prev_page_url' => $monthEvents->previousPageUrl(),
            'to' => $monthEvents->lastItem(),
            'total' => $monthEvents->total(),
        ];
        
        return response()->json($paginatedData);

    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'semester' => 'required|string',
            'description' => 'nullable|string',
        ]);

        AcademicCalendar::create($request->all());

        return redirect()->route('academic_calendar.index')->with('success', 'Event added successfully.');
    }

    public function edit(AcademicCalendar $academicCalendar)
    {
        return Inertia::render('AcademicCalendar/Edit', [
            'event' => $academicCalendar
        ]);
    }

    public function update(Request $request, AcademicCalendar $academicCalendar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'semester' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $academicCalendar->update($request->all());

        return redirect()->route('academic_calendar.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(AcademicCalendar $academicCalendar)
    {
        $academicCalendar->delete();
        return redirect()->route('academic_calendar.index')->with('success', 'Event deleted successfully.');
    }
}
