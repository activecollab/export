<?php

/*
 * This file is part of the Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Test\Mocks;

use ActiveCollab\Exporter\ExportableInterface;
use ActiveCollab\Exporter\ExportAsTableInterface;
use ActiveCollab\Exporter\ExportColumn;
use ActiveCollab\Exporter\ExportColumnInterface;
use Doctrine\Common\Inflector\Inflector;

class TableExporterMock extends MockBase implements ExportableInterface, ExportAsTableInterface
{
    const EXPORTER_FORMAT_EXCEL = 'xlsx';
    const EXPORTER_FORMAT_CSV = 'csv';
    const EXPORTER_FORMAT_PDF = 'pdf';

    const EXPORTER_TYPE_TABLE = 'table';
    const EXPORTER_TYPE_LIST = 'list';

    const EXPORT_PATH_EXCEL = '';
    const EXPORT_PATH_CSV = '';

    public $object_name;
    public $rows;
    public $columns;

    /**
     * Get exporter path.
     *
     * @param  string $type
     * @return string
     */
    public function getExportPath(string $type): string
    {
        $object_name = str_replace(' ', '_', Inflector::tableize($this->getObjectName()));

        return self::WORK_FOLDER . '/' . $object_name . '.' . $type;
    }

    /**
     * @param  array                            ...$args
     * @return iterable|ExportColumnInterface[]
     */
    public function getColumns(...$args): iterable
    {
        $columns = [];

        foreach ($this->columns as $column) {
            $align = isset($column['align']) ? $column['align'] : ExportColumnInterface::COLUMN_ALIGN_AUTO;
            $width = isset($column['width']) ? $column['width'] : ExportColumnInterface::COLUMN_WIDTH_AUTO;

            $columns[] = new ExportColumn($column['name'], $column['type'], $width, $align);
        }

        return $columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return iterable
     */
    public function getRows(): iterable
    {
        return !empty($this->rows) ? $this->rows : [];
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * Export excel.
     */
    public function exportExcel()
    {
        $path = $this->exporter_manager->export($this, self::EXPORTER_TYPE_TABLE, self::EXPORTER_FORMAT_EXCEL);
        return $path;
    }

    /**
     * Export CSV.
     */
    public function exportCsv()
    {
        $path = $this->exporter_manager->export($this, self::EXPORTER_TYPE_TABLE, self::EXPORTER_FORMAT_CSV);
        return $path;
    }

    /**
     * Set object name.
     *
     * @param string $value
     */
    public function setObjectName(string $value)
    {
        $this->object_name = $value;
    }

    /**
     * Get object name.
     *
     * @return string
     */
    public function getObjectName(): string
    {
        return !empty($this->object_name) ? $this->object_name : 'Object Name';
    }
}
