<?php
namespace App\Services;

use Filament\Panel as FilamentPanel;

class Panel
{
    private FilamentPanel $panel;
    private array $allowedRoles = [];

    public function __construct(FilamentPanel $panel, array $allowedRoles = [])
    {
        $this->panel = $panel;
        $this->allowedRoles = $allowedRoles;
    }

    public function getAllowedRoles(): array
    {
        return $this->allowedRoles;
    }

    public function setAllowedRoles(array $roles): void
    {
        $this->allowedRoles = $roles;
    }

    public function getPanel(): FilamentPanel
    {
        return $this->panel;
    }
}
