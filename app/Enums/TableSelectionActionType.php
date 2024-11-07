<?php
declare (strict_types=1);

namespace App\Enums;

enum TableSelectionActionType: string
{
    case DELETE = 'delete';
    case PUBLISH = 'publish';

    public function getLabel(): string
    {
        return match ($this) {
            self::DELETE => 'Delete selected',
            self::PUBLISH => 'Publish selected',
        };
    }
}
