<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exporter\Excel\ColumnFormatter;

use PHPExcel_Style_Alignment;

interface ExcelColumnFormatterInterface
{
    /**
     * Set column label.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface
     */
    public function setColumnLabel(string $value): ExcelColumnFormatterInterface;

    /**
     * Format column type.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface
     */
    public function formatType(string $value): ExcelColumnFormatterInterface;

    /**
     * Format column type.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface
     */
    public function formatAlign(string $value): ExcelColumnFormatterInterface;

    /**
     * Format column size.
     *
     * @param  string                        $value
     * @return ExcelColumnFormatterInterface
     */
    public function formatSize(string $value): ExcelColumnFormatterInterface;

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
    ): ExcelColumnFormatterInterface;
}
