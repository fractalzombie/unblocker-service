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

if (file_exists(dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php')) {
    require_once dirname(__DIR__).'/var/cache/prod/App_KernelProdContainer.preload.php';
}
