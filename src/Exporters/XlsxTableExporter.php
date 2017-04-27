<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters;

use ActiveCollab\Exporter\ExportAsTableInterface;
use Exception;

class XlsxTableExporter extends ExcelExporter
{

    /**
     * Export data as table.
     *
     * @param $object
     * @param  string    $path
     * @return string
     * @throws Exception
     */
    public function export($object, string $path): string
    {
        if (!($object instanceof ExportAsTableInterface)) {
            throw new Exception('$object argument need to be instance of: ExportAsTableInterface');
        }

        $active_sheet = $this->php_excel->setActiveSheetIndex(0);

        $this->setCreator();
        $columns = $object->getColumns();
        $this->setColumnRow($columns);

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

        $this->save($path);

        return $path;
    }
}
