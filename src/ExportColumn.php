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
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $width;

    /**
     * @var string
     */
    private $align;

    /**
     * ExportColumn constructor.
     *
     * @param string $name
     * @param string $type
     * @param string $width
     * @param string $align
     */
    public function __construct(string $name, string $type, string $width = 'auto', string $align = 'auto')
    {
        $this->name = $name;
        $this->type = $type;
        $this->width = $width;
        $this->align = $align;
    }

    /**
     * Get column.
     *
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->name;
    }

    /**
     * Column type.
     *
     * @throws Exception
     */
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

    /**
     * Column width.
     *
     * @return string
     */
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

    /**
     * Column align.
     *
     * @return string
     */
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
