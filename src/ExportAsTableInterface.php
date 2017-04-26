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
interface ExportAsTableInterface
{
    /**
     * @param  array                            ...$args
     * @return iterable|ExportColumnInterface[]
     */
    public function getColumns(...$args): iterable;

    public function getRows(): iterable;
}
