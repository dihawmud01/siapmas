<?php

namespace App\Http\Controllers;

use App\Enums\FileCategory;
use App\Models\SubmissionFile;
use App\Models\SubmissionRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LetterOfValidation extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $submissionRequests = SubmissionRequest::where('user_id', $user->id)->get();

        if ($user->id == 2) {
            $submissionRequests = SubmissionRequest::all();
        }

        return view(
            'admins.letters.sp.index',
            [
                //                'data' => Letter::incoming()->render($request->search),
                'search' => $request->search,
            ],
            compact('submissionRequests'),
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

        $submission = SubmissionRequest::create($validatedData);

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
                            'storage/sp/' . strtolower(str_replace(' ', '-', $user->pac->pac)) . '/' . $category,
                        ),
                        $newFileName,
                    );

                    SubmissionFile::create([
                        'submission_id' => $submission->id,
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
        $submission = SubmissionRequest::where('id', $id)->firstOrFail();

        $attachments = (object) SubmissionFile::where('submission_id', $submission->id)
            ->whereIn('category', [
                'request_letter',
                'documentation',
                'mwc_recommendation',
                'pac_recommendation',
                'election_report',
                'formation_report',
                'management_structure',
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

        return view('admins.letters.sp.show', compact('submission', 'attachments'));
    }
}
