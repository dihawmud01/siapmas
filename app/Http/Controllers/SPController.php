<?php

namespace App\Http\Controllers;

use App\Enums\FileCategory;
use App\Enums\SubmissionStatus;
use App\Models\SPSubmissionFile;
use App\Models\SP;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use setasign\Fpdi\Tcpdf\Fpdi;

class SPController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $letters = SP::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        if ($user->id == 2) {
            $letters = SP::orderBy('updated_at', 'desc')->get();
        }

        return view('admins.letters.sp.index', compact('letters', 'user'));
    }

    public function create()
    {
        $user = Auth::user();

        return view('admins.letters.sp.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            array_merge(
                [
                    'start_period' => 'required|integer',
                    'end_period' => 'required|integer',
                    'event_date' => 'required|date',
                    'event_location' => 'required|string|max:255',
                    'mwc_letter_number' => 'required|string|max:255',

                    'protectors' => 'nullable|array',
                    'advisors' => 'nullable|array',
                    'chairman' => 'required|string|max:255',
                    'vice_chairmen' => 'nullable|array',
                    'secretary' => 'required|string|max:255',
                    'vice_secretaries' => 'nullable|array',
                    'treasurer' => 'required|string|max:255',
                    'vice_treasurers' => 'nullable|array',
                    'organization_department_coordinator' => 'required|string|max:255',
                    'organization_department_members' => 'nullable|array',
                    'cadre_department_coordinator' => 'required|string|max:255',
                    'cadre_department_members' => 'nullable|array',
                    'dakwah_department_coordinator' => 'required|string|max:255',
                    'dakwah_department_members' => 'nullable|array',
                    'culture_department_coordinator' => 'required|string|max:255',
                    'culture_department_members' => 'nullable|array',
                    'economy_institution_director' => 'required|string|max:255',
                    'economy_institution_members' => 'nullable|array',
                    'press_institution_director' => 'required|string|max:255',
                    'press_institution_members' => 'nullable|array',
                    'brigade_institution_director' => 'required|string|max:255',
                    'brigade_institution_members' => 'nullable|array',
                ],
                [
                    'documentation' => 'nullable|array',
                    'documentation.*' => 'file|mimes:docx,jpeg,png,mp4|max:10240',
                    'request_letter' => 'required|file|mimes:pdf|max:10240',
                    'mwc_recommendation' => 'required|file|mimes:pdf|max:10240',
                    'pac_recommendation' => 'required|file|mimes:pdf|max:10240',
                    'election_report' => 'required|file|mimes:pdf|max:10240',
                    'formation_report' => 'required|file|mimes:pdf|max:10240',
                    'id_cv_photo_certificate' => 'required|file|mimes:pdf|max:10240',
                    'management_structure' => 'required|file|mimes:docx|max:10240',
                ],
            ),
        );

        $user = Auth::user();
        $validatedData['user_id'] = $user->id;

        $letter = SP::create($validatedData);

        $pacSlug = Str::slug($user->pac->pac);

        $fileCategories = [
            'documentation',
            'request_letter',
            'mwc_recommendation',
            'pac_recommendation',
            'election_report',
            'formation_report',
            'id_cv_photo_certificate',
            'management_structure',
        ];

        collect($fileCategories)->each(function ($category) use ($request, $letter, $pacSlug) {
            $path = "sp/{$pacSlug}/{$category}/{$letter->id}/";

            if ($request->hasFile($category)) {
                $files = is_array($request->file($category)) ? $request->file($category) : [$request->file($category)];

                foreach ($files as $file) {
                    $filename = "{$category}-" . Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs($path, $filename, 'public');

                    SPSubmissionFile::create([
                        'sp_id' => $letter->id,
                        'attachment' => $filename,
                        'category' => FileCategory::tryFrom($category),
                    ]);
                }
            }
        });

        Alert::success('Pengajuan berhasil dikirim', 'Data-data akan ditinjau terlebih dahulu oleh PC');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }

    public function show($id): View
    {
        $letter = SP::findOrFail($id);

        $attachments = (object) SPSubmissionFile::where('sp_id', $letter->id)
            ->whereIn('category', [
                'request_letter',
                'documentation',
                'mwc_recommendation',
                'pac_recommendation',
                'election_report',
                'formation_report',
                'management_structure',
                'id_cv_photo_certificate',
            ])
            ->get()
            ->groupBy('category')
            ->map(function ($group, $key) {
                if ($key === 'documentation') {
                    return $group->pluck('attachment');
                }
                return $group->pluck('attachment')->first();
            })
            ->toArray();

        return view('admins.letters.sp.show', compact('letter', 'attachments'));
    }

    public function approve(Request $request, SP $letter): RedirectResponse
    {
        $validatedLetterNum = $request->validate(['letter_number' => 'required|string|max:255']);

        $letter->update([
            'letter_number' => $validatedLetterNum['letter_number'],
            'status' => SubmissionStatus::APPROVED,
        ]);

        Alert::success('Pengajuan SP berhasil disetujui');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }

    public function reject(SP $letter): RedirectResponse
    {
        $letter->update([
            'status' => SubmissionStatus::REJECTED,
        ]);

        Alert::success('Pengajuan SP berhasil ditolak');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }

    public function generate(SP $letter)
    {
        $user = Auth::user();
        $pacSlug = Str::slug($user->pac->pac);
        $basePath = "sp/{$pacSlug}";
        $generatedPath = "{$basePath}/generated/{$letter->id}";

        Storage::disk('public')->makeDirectory($generatedPath);

        $coverPath = public_path('assets/documents/sp-cover.pdf');
        $modifiedCoverPath = "{$basePath}/sp-cover.pdf";
        $contentPath = "{$basePath}/content.pdf";
        $mergedPath = "{$generatedPath}/surat-pengesahan-" . now()->timestamp . '.pdf';

        $pac = in_array($user->pac_id, [28, 29]) ? $user->pac->pac : 'KECAMATAN ' . $user->pac->pac;

        if (! Storage::disk('public')->exists($modifiedCoverPath)) {
            $cover = new Fpdi();
            $cover->setSourceFile($coverPath);
            $tplIdx = $cover->importPage(1);
            $size = $cover->getTemplateSize($tplIdx);
            $cover->AddPage('P', [$size['width'], $size['height']]);
            $cover->useTemplate($tplIdx, 0, 0, $size['width'], $size['height']);
            $cover->setFont('Helvetica', 'B', 26);
            $cover->setTextColor(255, 255, 255);
            $cover->SetXY(59.5, 190);
            $cover->Cell(100, 10, $pac, 0, 0, 'C');

            Storage::disk('public')->put($modifiedCoverPath, $cover->Output('S'));
        }

        $contentPdf = Pdf::setPaper('A4', 'portrait')->loadView(
            'admins.letters.sp.pdf.content',
            compact('letter', 'pac'),
        );

        Storage::disk('public')->put($contentPath, $contentPdf->output());

        $merger = new Merger();
        $merger->addFile(Storage::disk('public')->path($modifiedCoverPath));
        $merger->addFile(Storage::disk('public')->path($contentPath));
        $mergedPdf = $merger->merge();

        Storage::disk('public')->put($mergedPath, $mergedPdf);
        Storage::disk('public')->delete($contentPath);

        return response()->file(Storage::disk('public')->path($mergedPath));
    }
}
