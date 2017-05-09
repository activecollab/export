<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporter\Excel\ColumnFormatter;

use ActiveCollab\Exporter\Exportable\Table\Column\ExportColumnInterface;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;
use PHPExcel_Worksheet;

class ExcelColumnFormatter implements ExcelColumnFormatterInterface
{
    const COLUMN_ROW_NUMBER = 1;
    const COLUMN_FREEZE_ROW = 2;

    private $active_sheet;
    private $column_key;

    /**
     * ExcelColumnFormatter.
     *
     * ExcelColumnFormatter constructor.
     * @param PHPExcel_Worksheet $active_sheet
     * @param string             $column_key
     */
    public function __construct(PHPExcel_Worksheet $active_sheet, string $column_key)
    {
        $this->active_sheet= $active_sheet;
        $this->column_key = $column_key;
    }

    /**
     * Set column label.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface $this
     */
    public function setColumnLabel(string $value): ExcelColumnFormatterInterface
    {
        $column_name = str_replace('_', ' ', $value);
        $this->active_sheet->setCellValue($this->column_key . self::COLUMN_ROW_NUMBER, $column_name);

        return $this;
    }

    /**
     * Format column align.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface $this
     */
    public function formatAlign(string $value): ExcelColumnFormatterInterface
    {
        switch ($value) {
            case ExportColumnInterface::COLUMN_ALIGN_CENTER:
                $align = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
                break;
            case ExportColumnInterface::COLUMN_ALIGN_LEFT:
                $align = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
                break;
            case ExportColumnInterface::COLUMN_ALIGN_RIGHT:
                $align = PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
                break;
            default:
                $align = false;
                break;
        }

        if ($align) {
            $this->active_sheet->getStyle($this->column_key)->getAlignment()->setHorizontal($align);
        }

        return $this;
    }

    /**
     * Format column type.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface $this
     */
    public function formatType(string $value): ExcelColumnFormatterInterface
    {

        switch ($value) {
            case ExportColumnInterface::COLUMN_TYPE_INT:
                $type = PHPExcel_Style_NumberFormat::FORMAT_NUMBER;
                break;
            case ExportColumnInterface::COLUMN_TYPE_FLOAT:
                $type = PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00;
                break;
            case ExportColumnInterface::COLUMN_TYPE_STRING:
                $type = PHPExcel_Style_NumberFormat::FORMAT_TEXT;
                break;
            case ExportColumnInterface::COLUMN_TYPE_DATE:
                $type = PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2;
                break;
            default:
                $type = false;
                break;
        }

        if ($type) {
            $this->active_sheet->getStyle($this->column_key)->getNumberFormat()->setFormatCode($type);
        }

        return $this;
    }

    /**
     * Format column size.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface $this
     */
    public function formatSize(string $value): ExcelColumnFormatterInterface
    {
        switch ($value) {
            case ExportColumnInterface::COLUMN_WIDTH_WIDE:
                $width = 70;
                break;
            case ExportColumnInterface::COLUMN_WIDTH_MEDIUM:
                $width = 50;
                break;
            case ExportColumnInterface::COLUMN_WIDTH_NORMAL:
                $width = 30;
                break;
            case ExportColumnInterface::COLUMN_WIDTH_SMALL:
                $width = 10;
                break;
            default:
                $width = false;
                break;
        }

        if ($width) {
            $this->active_sheet->getColumnDimension($this->column_key)->setWidth($width);
        } else {
            $this->active_sheet->getColumnDimension($this->column_key)->setAutoSize(true);
        }

        return $this;
    }

    /**
     * Prepare column cell for header.
     *
     * @param  string                        $background
     * @param  PHPExcel_Style_Alignment|null $align
     * @param  bool                          $freeze
     * @param  bool                          $filter
     * @param  string                        $start
     * @return ExcelColumnFormatterInterface
     */
    public function prepareForHeader(
        string $background = 'CCCCCC',
        PHPExcel_Style_Alignment $align = null,
        bool $freeze = true,
        bool $filter = true,
        string $start = 'A'
    ): ExcelColumnFormatterInterface
    {
        $column_cell = $this->column_key . self::COLUMN_ROW_NUMBER;

        if ($freeze) {
            $this->active_sheet->freezePane($this->column_key . self::COLUMN_FREEZE_ROW);
        }

        if ($filter) {
            $current_cell = $start . self::COLUMN_ROW_NUMBER;
            $this->active_sheet->setAutoFilter("{$column_cell}:{$current_cell}");
        }

        $cell = $this->active_sheet->getStyle($column_cell);

        $cell->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');
        $cell->getAlignment()->setHorizontal($align);


        return $this;
    }
}
