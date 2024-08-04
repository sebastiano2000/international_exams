<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Attachment;
use App\Models\Subject;
use Auth;
use Illuminate\Http\Request;
use Response;
use Storage;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.subject.index', [
                'subjects' => Subject::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

    public function filter(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.subject.index', [
                'subjects' => Subject::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

    public function upsert(Subject $subject)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.subject.upsert', [
                'subject' => $subject,
            ]);
        } else {
            abort(404);
        }
    }

    public function modify(SubjectRequest $request)
    {
        return Subject::upsertInstance($request);
    }

    public function destroy(Subject $subject)
    {
        return $subject->deleteInstance();
    }

    public function indexAttachment(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.attachment.index', [
                'attachments' => Attachment::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

    public function filterAttachment(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.attachment.index', [
                'attachments' => Attachment::filter($request->all())->paginate(50),
            ]);
        } else {
            abort(404);
        }
    }

    public function upsertAttachment(Attachment $attachment)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.attachment.upsert', [
                'attachment' => $attachment,
            ]);
        } else {
            abort(404);
        }
    }

    public function modifyAttachment(AttachmentRequest $request)
    {
        return Attachment::upsertInstance($request);
    }

    public function destroyAttachment(Attachment $attachment)
    {
        return $attachment->deleteInstance();
    }

    public function getVideo(Attachment $attachment)
    {
        $filename = $attachment->picture->name;
        $second_id = $attachment->picture->second_id;
        return response()->download(storage_path('/app/public/' . $filename . '/' . $second_id), null, [], null);
    }
}
