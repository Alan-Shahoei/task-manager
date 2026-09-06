<?php

namespace App\Services;

use App\Models\Section;
use App\Repositories\SectionMemberRepository;
use App\Repositories\SectionRepository;

class SectionService
{
    public function __construct(
        private SectionRepository $sectionRepository,
        private SectionMemberRepository $memberRepository
    ) {
    }
    public function createSection(string $name, string $color): Section
    {
        return new Section::class;
    }

    public function getSections()
    {

    }

    public function getSection(int $id)
    {

    }

    public function updateSection()
    {

    }

    public function deleteSection(int $id)
    {

    }

    public function getUserSections(int $userId)
    {

    }

}