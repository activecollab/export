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
    public function setLabel(string $value): ExcelColumnFormatterInterface;
    public function formatType(string $value): ExcelColumnFormatterInterface;
    public function formatAlign(string $value): ExcelColumnFormatterInterface;
    public function formatSize(string $value): ExcelColumnFormatterInterface;
    public function prepareForHeader(
        string $background = 'CCCCCC',
        PHPExcel_Style_Alignment $align = null,
        bool $freeze = true,
        bool $filter = true,
        string $start = 'A'
    ): ExcelColumnFormatterInterface;
}
