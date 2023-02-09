<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Services\Note\NoteService;
use Illuminate\Http\Request;

class NoteController extends BaseController
{

    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index()
    {
        return $this->sendResponse($this->noteService->getList(), "", 200);
    }

    public function store(Request $request)
    {
        $adminArray = [
            'title' => $request->title,
            'content' => $request->content
        ];

        return $this->sendResponse($this->noteService->store($adminArray), "", 201);
    }

    public function show($id)
    {
        return $this->sendResponse($this->noteService->get($id), "", 200);
    }

}