<?php
declare (strict_types=1);

namespace App\Enums;

enum BulkActionType: string
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

    public function getLevel(): string
    {
        return match ($this) {
            self::DELETE => 'error',
            self::PUBLISH => 'success',
        };
    }

    public function hasConfirm() : bool
    {
        return match ($this) {
            self::DELETE => true,
            self::PUBLISH => false,
        };
    }
}
