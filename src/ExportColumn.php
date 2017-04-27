<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use Exception;

class ExportColumn implements ExportColumnInterface
{
    private $name;

    private $type;

    private $width;

    private $align;

    public function __construct(string $name, string $type, string $width = 'auto', string $align = 'auto')
    {
        $this->name = $name;
        $this->type = $type;
        $this->width = $width;
        $this->align = $align;
    }

    public function getColumnName(): string
    {
        return $this->name;
    }

    public function getColumnType(): string
    {
        $types = self::COLUMN_TYPES;

        if (in_array($this->type, $types)) {
            $key = array_search($this->type, $types);
            return $types[$key];
        } else {
            throw new Exception("Type doesn't exists");
        }
    }

    public function getWidth(): string
    {
        $size = self::COLUMN_WIDTHS;

        if (in_array($this->width, $size)) {
            $key = array_search($this->width, $size);
            return $size[$key];
        } else {
            return self::COLUMN_WIDTH_AUTO;
        }
    }

    public function getAlign(): string
    {
        $align = self::COLUMN_ALIGNS;

        if (in_array($this->align, $align)) {
            $key = array_search($this->align, $align);
            return $align[$key];
        } else {
            return self::COLUMN_ALIGN_AUTO;
        }
    }
}
