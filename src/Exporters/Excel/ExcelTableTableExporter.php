<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters\Excel;

use ActiveCollab\Exporter\ExportColumnInterface;
use ActiveCollab\Exporter\Exporters\Excel\ColumnFormatter\ExcelColumnFormatter;
use PHPExcel;
use PHPExcel_IOFactory;

abstract class ExcelTableTableExporter implements ExcelTableExporterInterface
{
    protected function initializeDocument(
        PHPExcel $php_excel,
        string $creator = 'Active Collab Export library',
        string $title = 'Data Export'
    ): PHPExcel
    {
        $php_excel
            ->getProperties()
            ->setCreator($creator)
            ->setTitle($title)
            ->setSubject($title);

        return $php_excel;
    }

    protected function setColumnRow(PHPExcel $php_excel, array $columns, bool $apply_formatting = true): PHPExcel
    {
        $active_sheet = $php_excel->getActiveSheet();
        $column_iterator = $active_sheet->getColumnIterator();
        $key = null;

        /** @var ExportColumnInterface $column */
        foreach ($columns as $column) {
            $key = $column_iterator->key();

            $column_formatter = new ExcelColumnFormatter($active_sheet, $key);

            $column_formatter->setColumnLabel($column->getColumnName());

            if ($apply_formatting) {
                $column_formatter
                    ->setColumnLabel($column->getColumnName())
                    ->formatType($column->getColumnType())
                    ->formatAlign($column->getAlign())
                    ->formatSize($column->getWidth())
                    ->prepareForHeader();
            }

            $column_iterator->next();
        }

        return $php_excel;
    }

    protected function save(PHPExcel $php_excel, string $path, string $format = 'Excel2007'): string
    {
        PHPExcel_IOFactory::createWriter($php_excel, $format)->save($path);

        return $path;
    }
}
