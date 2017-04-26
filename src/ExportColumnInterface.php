<?php

/*
 * This file is part of the Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

interface ExportColumnInterface
{
    const COLUMN_TYPE_INT = 'int';
    const COLUMN_TYPE_FLOAT = 'float';
    const COLUMN_TYPE_STRING = 'string';
    const COLUMN_TYPE_DATE = 'date';

    const COLUMN_ALIGN_AUTO = 'auto';
    const COLUMN_ALIGN_CENTER = 'center';
    const COLUMN_ALIGN_LEFT = 'left';
    const COLUMN_ALIGN_RIGHT = 'right';

    const COLUMN_WIDTH_AUTO = 'auto';
    const COLUMN_WIDTH_SMALL = 'small';
    const COLUMN_WIDTH_NORMAL = 'normal';
    const COLUMN_WIDTH_MEDIUM = 'medium';
    const COLUMN_WIDTH_WIDE = 'wide';

    const COLUMN_TYPES = [
        self::COLUMN_TYPE_INT,
        self::COLUMN_TYPE_FLOAT,
        self::COLUMN_TYPE_STRING,
        self::COLUMN_TYPE_DATE,
    ];

    const COLUMN_ALIGNS = [
        self::COLUMN_ALIGN_CENTER,
        self::COLUMN_ALIGN_LEFT,
        self::COLUMN_ALIGN_RIGHT,
    ];

    const COLUMN_WIDTHS = [
        self::COLUMN_WIDTH_AUTO,
        self::COLUMN_WIDTH_SMALL,
        self::COLUMN_WIDTH_NORMAL,
        self::COLUMN_WIDTH_MEDIUM,
        self::COLUMN_WIDTH_WIDE,
    ];

    /**
     * @return string
     */
    public function getColumnName(): string;

    /**
     * @return string
     */
    public function getColumnType(): string;

    /**
     * @return string
     */
    public function getWidth(): string;

    /**
     * @return string
     */
    public function getAlign(): string;
}
