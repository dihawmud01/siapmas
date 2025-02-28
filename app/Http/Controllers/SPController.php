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

        return view(
            'admins.letters.sp.index',
            [
                //                'data' => Letter::incoming()->render($request->search),
                'search' => $request->search,
            ],
            compact('letters', 'user'),
        );
    }

    public function create()
    {
        $user = Auth::user();

        return view('admins.letters.sp.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Attachments
            'event_date' => 'required|date',
            'event_location' => 'required|string|max:255',
            'mwc_letter_number' => 'required|string|max:255',

            // Management Structure
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
        ]);

        $user = Auth::user();
        $validatedData['user_id'] = $user->id;

        $letter = SP::create($validatedData);

        $request->only([
            'documentation' => 'nullable|array',
            'documentation.*' => 'required|file|mimes:docx,jpeg,png,mp4|max:10240',
            'request_letter' => 'required|file|mimes:pdf|max:10240',
            'mwc_recommendation' => 'required|file|mimes:pdf|max:10240',
            'pac_recommendation' => 'required|file|mimes:pdf|max:10240',
            'election_report' => 'required|file|mimes:pdf|max:10240',
            'formation_report' => 'required|file|mimes:pdf|max:10240',
            'id_cv_photo_certificate' => 'required|file|mimes:pdf|max:10240',
            'management_structure' => 'required|file|mimes:docx|max:10240',
        ]);

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

        foreach ($fileCategories as $category) {
            if ($request->hasFile($category)) {
                $files = is_array($request->file($category)) ? $request->file($category) : [$request->file($category)];

                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $newFileName = $category . '-' . now()->timestamp . '.' . $extension;
                    $file->move(
                        public_path(
                            'storage/sp/' .
                                strtolower(str_replace(' ', '-', $user->pac->pac)) .
                                '/' .
                                $category .
                                '/' .
                                $letter->id,
                        ),
                        $newFileName,
                    );

                    SPSubmissionFile::create([
                        'sp_id' => $letter->id,
                        'attachment' => $newFileName,
                        'category' => FileCategory::tryFrom($category),
                    ]);
                }
            }
        }

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
        //        dd($letter->id);
        return view('admins.letters.sp.show', compact('letter', 'attachments'));
    }

    public function update($id, Request $request): RedirectResponse
    {
        $validatedLetterNum = $request->validate(['letter_number' => 'required|string|max:255']);

        $letter = SP::findOrFail($id);

        $letter->update([
            'letter_number' => $validatedLetterNum['letter_number'],
            'status' => SubmissionStatus::APPROVED,
        ]);

        Alert::success('Pengajuan SP Berhasil disetujui');

        return redirect()->route('dashboard.letters.validation-submission.index');
    }

    public function generate($id)
    {
        $coverPath = public_path('assets/documents/sp-cover.pdf');
        $user = Auth::user();
        $letter = SP::findOrFail($id);

        $modifiedCoverDir = public_path('storage/sp/' . strtolower(str_replace(' ', '-', $user->pac->pac)));

        if (! is_dir($modifiedCoverDir)) {
            mkdir($modifiedCoverDir, 0755, true);
        }

        $modifiedCoverPath = $modifiedCoverDir . '/sp-cover.pdf';

        $pac = '';

        if (in_array($user->pac_id, [28, 29])) {
            $pac = $user->pac->pac;
        } else {
            $pac = 'KECAMATAN ' . $user->pac->pac;
        }

        if (! file_exists($modifiedCoverPath)) {
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

            $cover->Output($modifiedCoverPath, 'F');
        }

        $contentPdf = Pdf::setPaper('A4', 'portrait')->loadView(
            'admins.letters.sp.pdf.content',
            compact('letter', 'pac'),
        );
        $contentPath = public_path('storage/sp/content.pdf');
        file_put_contents($contentPath, $contentPdf->output());

        $merger = new Merger();
        $merger->addFile($modifiedCoverPath);
        $merger->addFile($contentPath);
        $mergedPdf = $merger->merge();

        $mergedDirectory = public_path(
            'storage/sp/' . strtolower(str_replace(' ', '-', $user->pac->pac)) . '/generated/' . $letter->id,
        );

        if (! is_dir($mergedDirectory)) {
            mkdir($mergedDirectory, 0755, true);
        }

        $mergedPath = $mergedDirectory . '/surat-pengesahan-' . now()->timestamp . '.pdf';

        file_put_contents($mergedPath, $mergedPdf);

        Storage::delete($contentPath);

        return response($mergedPdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="surat-pengesahan.pdf"');
    }
}
