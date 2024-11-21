<?php
declare (strict_types=1);

namespace App\Enums;

use App\Livewire\Table\Interface\BulkActionTypeInterface;

enum PostBulkActionType: string implements BulkActionTypeInterface
{
    case DELETE = 'delete';
    case PUBLISH = 'publish';

    public function getLabel(): string
    {
        return match ($this) {
            self::DELETE => 'Delete',
            self::PUBLISH => 'Publish',
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

    public function getVerb() : string
    {
        return match ($this) {
            default => str_ends_with($this->value, 'e') ? $this->value . 'd' : $this->value . 'ed',
        };
    }
}
