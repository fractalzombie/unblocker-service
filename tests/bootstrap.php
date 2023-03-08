<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Tests;

use Symfony\Component\Dotenv\Dotenv;

require_once \dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(\dirname(__DIR__).'/config/bootstrap.php')) {
    require_once \dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(\dirname(__DIR__).'/.env');
}
