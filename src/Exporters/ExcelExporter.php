<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporters;

use ActiveCollab\Exporter\ExportColumnInterface;
use ActiveCollab\Exporter\Exporters\Excel\ExcelColumnFormatter;
use PHPExcel;
use PHPExcel_IOFactory;

abstract class ExcelExporter implements ExporterInterface
{
    public $php_excel;

    public function __construct()
    {
        $this->php_excel = new PHPExcel();
    }

    /**
     * Set creator.
     *
     * @param string $key_word
     * @param string $title
     */
    protected function setCreator(string $key_word = 'Active Collab', $title = 'AC Export')
    {
        $this->php_excel
            ->getProperties()
            ->setCreator('Active Collab')
            ->setLastModifiedBy("Active Collab")
            ->setTitle($title)
            ->setSubject($title)
            ->setKeywords($key_word);
    }

    /**
     *
     *
     * @param array $columns
     * @param bool  $format
     */
    protected function setColumnRow(array $columns, bool $format = true)
    {
        $active_sheet = $this->php_excel->getActiveSheet();
        $column_iterator = $active_sheet->getColumnIterator();
        $key = null;

        /** @var ExportColumnInterface $column */
        foreach ($columns as $column) {
            $key = $column_iterator->key();

            $column_formatter = new ExcelColumnFormatter($active_sheet, $key);

            $column_formatter->setColumnLabel($column->getColumnName());

            if ($format) {
                $column_formatter
                    ->setColumnLabel($column->getColumnName())
                    ->formatType($column->getColumnType())
                    ->formatAlign($column->getAlign())
                    ->formatSize($column->getWidth())
                    ->prepareForHeader();
            }

            $column_iterator->next();
        }
    }

    /**
     * Save file.
     *
     * @param  string $path
     * @param  string $format
     * @return mixed
     */
    protected function save(string $path, string $format = 'Excel2007')
    {
        $writer = PHPExcel_IOFactory::createWriter($this->php_excel, $format);
        return $writer->save($path);
    }
}
