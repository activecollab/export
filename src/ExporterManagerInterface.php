<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

interface ExporterManagerInterface
{
    /**
     * Get export.
     *
     * @param  ExportableInterface $object
     * @param  string              $type
     * @param  string              $format
     * @return string
     */
    public function export(ExportableInterface $object, string $type, string $format): string;
}
