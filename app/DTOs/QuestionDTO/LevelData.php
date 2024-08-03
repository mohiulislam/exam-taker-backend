<?php
namespace App\DTOs\QuestionDTO;

use Spatie\LaravelData\Data;

class LevelData extends QuestionEntityData
{
    public function __construct(
        string $title,
        ?string $details,
        ?string $image,
        bool $status
    ) {
        parent::__construct($title, $details, $image, $status);
    }
}
