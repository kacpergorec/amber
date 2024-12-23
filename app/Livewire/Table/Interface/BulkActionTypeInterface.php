<?php
declare (strict_types=1);

namespace App\Livewire\Table\Interface;

interface BulkActionTypeInterface extends \BackedEnum
{
    public function getLabel(): string;

    public function getLevel(): string;

    public function hasConfirm() : bool;

    public function getVerb() : string;
}
