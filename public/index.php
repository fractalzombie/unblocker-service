<?php

declare(strict_types=1);

use UnBlockerService\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return fn (array $context) => Kernel::fromContext($context);
