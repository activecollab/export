<?php

/*
 * This file is part of the Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

/**
 * @package ActiveCollab\Exporter
 */
interface ExportableInterface
{
    /**
     * Get exporter path.
     *
     * @param  string $type
     * @return string
     */
    public function getExportPath(string $type): string;
}
