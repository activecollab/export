<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporter\Table;

use ActiveCollab\Exporter\Exportable\Table\Column\ExportColumnInterface;
use ActiveCollab\Exporter\Exportable\Table\ExportableAsTableInterface;
use ActiveCollab\Exporter\Exporter\Excel\ExcelTableTableExporter;
use Exception;

class CsvTableExporter extends ExcelTableTableExporter implements CsvTableExporterInterface
{
    public function export($object, string $path): string
    {
        if (!($object instanceof ExportableAsTableInterface)) {
            throw new Exception('$object argument need to be instance of: ExportAsTableInterface');
        }

        $export_handle = fopen($path, 'w');

        if (!$export_handle) {
            throw new Exception("Export file is not writable {$export_handle}");
        }

        fwrite($export_handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
        $this->setColumnRow($export_handle, $object->getColumns());

        foreach ($object->getRows() as $row) {
            foreach ($row as $row_name => &$value) {
                if (preg_match('/^[\+|\=|\-|\@]/', (string) $value)) {
                    $value = "'" . $value;
                }
            }

            fputcsv($export_handle, $row, self::DEFAULT_CSV_SEPARATOR);
        }

        return $path;
    }

    /**
     * @param                                $export_handle
     * @param ExportColumnInterface[] |array $columns
     */
    protected function setColumnRow($export_handle, array $columns): void
    {
        $column_row = [];

        foreach ($columns as $column) {
            $column_row[] = $column->getName();
        }

        fputcsv($export_handle, $column_row, self::DEFAULT_CSV_SEPARATOR);
    }
}
