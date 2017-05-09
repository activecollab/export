<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporter\Table;

use ActiveCollab\Exporter\ExportAsTableInterface;
use ActiveCollab\Exporter\Exporter\Excel\ExcelTableTableExporter;
use ActiveCollab\Exporter\Exporter\TableExporterInterface;
use ActiveCollab\Exporter\Exporter\XlsxExporterInterface;
use ActiveCollab\Exporter\Exporter\Table\XlsxTableExporterInterface;
use Exception;
use PHPExcel;

class XlsxTableExporter extends ExcelTableTableExporter implements XlsxTableExporterInterface
{
    public function export($object, string $path): string
    {
        if (!$object instanceof ExportAsTableInterface) {
            throw new Exception('$object argument need to be instance of: ExportAsTableInterface');
        }

        $php_excel = $this->initializeDocument(new PHPExcel());

        $active_sheet = $php_excel->setActiveSheetIndex(0);
        $php_excel = $this->setColumnRow($php_excel, $object->getColumns());

        $i = 2; // Start from two because 1 is column names

        $column_iterator = $active_sheet->getColumnIterator();

        foreach ($object->getRows() as $row) {
            $column_iterator->resetStart();
            $cell_formatter_index = 0;

            foreach ($row as $cell_value) {
                $active_sheet->setCellValue($column_iterator->key() . $i, $cell_value);
                $column_iterator->next();

                $cell_formatter_index++;
            }

            $i++;
        }

        $this->save($php_excel, $path);

        return $path;
    }
}
