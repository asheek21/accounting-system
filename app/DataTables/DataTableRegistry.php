<?php

namespace App\DataTables;

use App\DataTables\Contracts\DataTableInterface;
use App\DataTables\Contracts\ExportableColumnInterface;
use InvalidArgumentException;

/**
 * Registry class that maps DataTable "types" to handler classes.
 */
class DataTableRegistry
{
    protected $tables = [];

    /**
     * Register a new DataTable type with a handler class.
     *
     * @param  string  $type  Unique type identifier for the table.
     * @param  string  $class  Fully qualified handler class name.
     */
    public function register(string $type, string $class)
    {
        $this->tables[$type] = $class;
    }

    /**
     * Resolve a DataTable handler by type.
     * Throws exception if type is unknown.
     *
     * @throws InvalidArgumentException
     */
    public function resolve(string $type): DataTableInterface
    {
        if (! isset($this->tables[$type])) {
            throw new InvalidArgumentException("Unknown datatable type: {$type}");
        }

        return app($this->tables[$type]);
    }

    public function columns(string $type): array
    {
        $handler = $this->resolve($type);

        if ($handler instanceof ExportableColumnInterface) {
            return $handler->columns();
        }

        return [];
    }
}
