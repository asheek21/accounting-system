<?php

namespace App\DataTables\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataTableExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public array $value;

    public array $columns;

    public Builder $query;

    public function query(): Builder
    {
        return $this->query;
    }

    public function values($rows)
    {
        $this->value = array_keys($rows);
    }

    public function columns($columns)
    {
        $this->columns = array_values($columns);
    }

    public function map($query): array
    {
        $data = [];

        foreach ($this->value as $row) {
            $data[] = data_get($query, $row);
        }

        return $data;
    }

    public function headings(): array
    {
        return $this->columns;
    }

    public function setQuery(Builder $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function setMappingAndHeading(array $columns): self
    {
        $this->values($columns);
        $this->columns($columns);

        return $this;
    }
}
