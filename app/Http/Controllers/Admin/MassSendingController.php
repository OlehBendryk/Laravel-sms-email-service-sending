<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmailSendingCreateRequest;
use App\Jobs\MassSendingJob;
use App\Repositories\MessageTemplateRepository;
use App\Repositories\GroupRepository;
use App\Services\EmailSendingService;

class MassSendingController extends BaseController
{
    private $groupRepository;
    private $messageTemplateRepository;
    private $emailSendingService;

    /**
     * @param $groupRepository
     */
    public function __construct(GroupRepository $groupRepository, MessageTemplateRepository $messageTemplateRepository, EmailSendingService $emailSendingService)
    {
        parent::__construct();
        $this->groupRepository = $groupRepository;
        $this->messageTemplateRepository = $messageTemplateRepository;
        $this->emailSendingService = $emailSendingService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $recipients = $this->groupRepository->getNameArray();
        $msg_templates = $this->messageTemplateRepository->getAllMessageTemplates();

        return view('admin.sending.create')
            ->with('recipients', $recipients)
            ->with('msg_templates', $msg_templates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EmailSendingCreateRequest $request)
    {
        $email_sending = $this->emailSendingService->create($request->all());
        $msg_template = $email_sending->msg_templates()->get()->first();

        if (!$request->get('send_at')) {
            (new MassSendingJob())->handle($email_sending->id);
        }

        return redirect()->route('sending.create')
            ->with('success', "Email {$msg_template->subject} successfully send");
    }
}
