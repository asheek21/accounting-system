<?php

namespace App\DataTables\Contracts;

interface ExportableColumnInterface
{
    public function columns(): array;
}
