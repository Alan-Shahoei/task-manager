<?php

namespace App\Controllers;

use App\Services\SectionService;
use App\Services\ValidatorService;
use Framework\Response;

class SectionController
{
    public function __construct(
        private ValidatorService $validatorService,
        private SectionService $sectionService
    ) {
    }

    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        $this->validatorService->validate(
            $data, ['name' => ['required']]
        );

        $section = $this->sectionService->createSection(
            $data['name'],
            $data['color']
        );

        Response::json([
            'message' => 'section created successfully',
            'section' => [
                'id' => $section->getId(),
                'name' => $section->getName(),
                'color' => $section->getColor()
            ]
        ]);
    }

    public function index()
    {

    }

    public function show(int $id)
    {

    }

    public function update(int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function userSections(int $userId) {

    }
}