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
use ActiveCollab\Exporter\Exporter\Excel\ColumnFormatter\ExcelColumnFormatter;
use ActiveCollab\Exporter\Exporter\Excel\ExcelTableTableExporter;
use Exception;
use PHPExcel;
use PHPExcel_IOFactory;

class XlsxTableExporter extends ExcelTableTableExporter implements XlsxTableExporterInterface
{
    protected $php_excel = null;

    public function __construct()
    {
        $this->php_excel = new PHPExcel();

        $this->php_excel
            ->getProperties()
            ->setCreator('Active Collab Export library')
            ->setTitle('Data Export')
            ->setSubject('Data Export');
    }

    public function export($object, string $path): string
    {
        if (!$object instanceof ExportableAsTableInterface) {
            throw new Exception('$object argument need to be instance of: ExportAsTableInterface');
        }

        $active_sheet = $this->php_excel->setActiveSheetIndex(0);
        $this->setColumnRow($object->getColumns());

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

        PHPExcel_IOFactory::createWriter($this->php_excel, 'Excel2007')->save($path);

        return $path;
    }

    private function setColumnRow(array $columns, bool $apply_formatting = true): void
    {
        $active_sheet = $this->php_excel->getActiveSheet();
        $column_iterator = $active_sheet->getColumnIterator();
        $key = null;

        /** @var ExportColumnInterface $column */
        foreach ($columns as $column) {
            $key = $column_iterator->key();

            $column_formatter = new ExcelColumnFormatter($active_sheet, $key);

            $column_formatter->setLabel($column->getName());

            if ($apply_formatting) {
                $column_formatter
                    ->setLabel($column->getName())
                    ->formatType($column->getType())
                    ->formatAlign($column->getAlign())
                    ->formatSize($column->getWidth())
                    ->prepareForHeader();
            }

            if ($apply_formatting) {
                $active_sheet->freezePane(ExcelColumnFormatter::COLUMN_FREEZE_ROW);
            }

            $column_iterator->next();
        }
    }
}
