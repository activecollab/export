<?php

/*
 * This file is part of the Active Collab Export project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Exporter;

use ActiveCollab\Exporter\Exportable\ExportableInterface;

interface ExportManagerInterface
{
    public function export(ExportableInterface $object, string $type, string $format): string;
}
