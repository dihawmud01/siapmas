<?php

namespace App\Http\Controllers;

use App\Models\HBN;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $user = Auth::user();

        $hbn = HBN::latest()
            ->take(20)
            ->get()
            ->map(function ($day) {
                $day->formatted_date = Carbon::parse($day->date)->translatedFormat('l, d F Y');

                return $day;
            });

        $events = Agenda::latest()
            ->get()
            ->map(function ($event) {
                $event->formatted_date = Carbon::parse($event->date)->translatedFormat('l, d F Y');
                $event->time = Carbon::parse($event->date)->translatedFormat('H:i');

                return $event;
            });

        return view('users.calendar', compact('events', 'user', 'hbn', 'events'));
    }

    public function adminIndex()
    {
        $events = Agenda::all();

        return view('admins.calendar.index', compact('events'));
    }

    public function create()
    {
        $organizers = [
            'PAC BATURRADEN',
            'PAC CILONGOK',
            'PAC KEDUNGBANTENG',
            'PAC KARANGLEWAS',
            'PAC PURWOJATI',
            'PAC PURWOKERTO BARAT',
            'PAC PURWOKERTO TIMUR',
            'PAC PURWOKERTO UTARA',
            'PAC PURWOKERTO SELATAN',
            'PAC SUMBANG',
            'PAC SOKARAJA',
            'PAC KEMBARAN',
            'PAC TAMBAK',
            'PAC SOMAGEDE',
            'PAC BANYUMAS',
            'PAC KEMRANJEN',
            'PAC GUMELAR',
            'PAC AJIBARANG',
            'PAC PEKUNCEN',
            'PAC WANGON',
            'PAC RAWALO',
            'PAC JATILAWANG',
            'PAC KEBASEN',
            'PAC PATIKRAJA',
            'PAC KALIBAGOR',
            'PAC LUMBIR',
            'PAC SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        $categories = ['Formal', 'Nonformal', 'Informal'];

        return view('admins.calendar.create', compact('organizers', 'categories'));
    }

    public function store(Request $request)
    {
        $events = $request->all();

        if ($request->pamflet) {
            $extension = $request->pamflet->getClientOriginalExtension();
            $newFileName = 'agenda' . '_' . $request->organizer . '-' . now()->timestamp . '.' . $extension;
            $request->file('pamflet')->move(public_path('/storage/images'), $newFileName);
            $events['pamflet'] = $newFileName;
        }

        Agenda::create($events);

        Alert::success('Mantap Sahabat', 'Agenda Berhasil Ditambahkan');

        return redirect()->route('admin.calendar.index');
    }

    public function edit($id, Request $request)
    {
        $event = Agenda::find($id);

        $organizers = [
            'PAC BATURRADEN',
            'PAC CILONGOK',
            'PAC KEDUNGBANTENG',
            'PAC KARANGLEWAS',
            'PAC PURWOJATI',
            'PAC PURWOKERTO BARAT',
            'PAC PURWOKERTO TIMUR',
            'PAC PURWOKERTO UTARA',
            'PAC PURWOKERTO SELATAN',
            'PAC SUMBANG',
            'PAC SOKARAJA',
            'PAC KEMBARAN',
            'PAC TAMBAK',
            'PAC SOMAGEDE',
            'PAC BANYUMAS',
            'PAC KEMRANJEN',
            'PAC GUMELAR',
            'PAC AJIBARANG',
            'PAC PEKUNCEN',
            'PAC WANGON',
            'PAC RAWALO',
            'PAC JATILAWANG',
            'PAC KEBASEN',
            'PAC PATIKRAJA',
            'PAC KALIBAGOR',
            'PAC LUMBIR',
            'PAC SUMPIUH',
            'KOMISARIAT UNU PURWOKERTO',
            'KOMISARIAT UIN SAIZU PURWOKERTO',
        ];

        $categories = ['Formal', 'Nonformal', 'Informal'];

        return view('admins.calendar.edit', compact('event', 'organizers', 'categories'));
    }

    public function update($id, Request $request)
    {
        $eventToUpdate = Agenda::findOrFail($id);
        $event = $request->all();

        // Periksa apakah checkbox dicentang atau tidak
        $status = isset($event['status']) ? true : false;
        $event['status'] = $status;

        $eventToUpdate->update($event);

        Alert::success('Mantap Sahabat', 'Agenda Berhasil Di Ubah');

        return redirect()->route('admin.calendar.index');
    }

    public function destroy($id)
    {
        $events = Agenda::findOrFail($id);
        $events->delete();

        Alert::success('Mantap Sahabat', 'Agenda Berhasil Dihapus');

        return redirect()->route('admin.calendar.index');
    }
}
