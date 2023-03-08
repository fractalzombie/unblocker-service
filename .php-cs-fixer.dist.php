<?php

declare(strict_types=1);

$header = <<<EOF
UnBlocker service for routers.

(c) Mykhailo Shtanko <fractalzombie@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude('var')
    ->exclude('vendor')
    ->notPath('#Enum#')
    ->in(__DIR__)
;

$rules = [
    'header_comment' => ['header' => $header],
    '@PSR2' => true,
    '@PSR12' => true,
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PhpCsFixer' => true,
    '@PHP80Migration' => true,
    '@PHP80Migration:risky' => true,
    '@PHP81Migration' => true,
    '@PHP81Migration:risky' => true,
    '@PHP82Migration' => true,
    '@PHP82Migration:risky' => true,
    '@PHPUnit84Migration:risky' => true,
    'date_time_immutable' => true,
    'single_line_throw' => true,
    'php_unit_internal_class' => false,
    'phpdoc_align' => ['align' => 'left'],
    'php_unit_test_case_static_method_calls' => false,
    'php_unit_test_class_requires_covers' => false,
    'phpdoc_line_span' => ['const' => 'single', 'property' => 'single', 'method' => 'single'],
    'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true],
];

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder)
;
