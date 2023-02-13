<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
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
        return $this->sendResponse(new NoteCollection($this->noteService->getList()), "", 200);
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
        return $this->sendResponse(new NoteResource($this->noteService->get($id)), "", 200);
    }

    public function getBySlug($slug)
    {
        return $this->sendResponse(new NoteResource($this->noteService->getBySlug($slug)), "", 200);
    }

    public function listByTitle($title)
    {
        return $this->sendResponse(new NoteCollection($this->noteService->listByTitle($title)), "", 200);
    }

    public function updateTitleById(Request $request, $id)
    {
        $title = $request->title;
        return $this->sendResponse($this->noteService->updateTitleById($id, $title), "", 200);
    }

    public function updateContentById(Request $request, $id)
    {
        $content = $request->content;
        return $this->sendResponse($this->noteService->updateContentById($id, $content), "", 200);
    }

    public function delete($id)
    {
        return $this->sendResponse($this->noteService->delete($id), "", 204);
    }
}
