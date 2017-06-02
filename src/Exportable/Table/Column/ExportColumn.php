<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter\Exportable\Table\Column;

use InvalidArgumentException;

class ExportColumn implements ExportColumnInterface
{
    private $name;

    private $type;

    private $width;

    private $align;

    private $permanently;

    private $dependency_columns;

    public function __construct(
        string $name,
        string $type,
        string $width = self::COLUMN_WIDTH_AUTO,
        string $align = self::COLUMN_ALIGN_AUTO,
        bool $permanently = true,
        array $dependency_columns = []
    )
    {
        if (!in_array($width, self::COLUMN_WIDTHS)) {
            throw new InvalidArgumentException("Width '{$width}' is not supported.");
        }

        if (!in_array($align, self::COLUMN_ALIGNS)) {
            throw new InvalidArgumentException("Align '{$align}' is not supported.");
        }

        $this->name = $name;
        $this->type = $type;
        $this->width = $width;
        $this->align = $align;
        $this->permanently = $permanently;
        $this->dependency_columns = $dependency_columns;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function getAlign(): string
    {
        return $this->align;
    }

    public function isPermanently(): bool
    {
        return $this->permanently;
    }

    public function getDependencyColumns(): iterable
    {
        return $this->dependency_columns;
    }
}
