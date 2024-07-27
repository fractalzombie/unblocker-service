<?php

declare(strict_types=1);

$owner = 'Mykhailo Shtanko';
$email = 'fractalzombie@gmail.com';
$year = date('Y');
$projectDirectory = __DIR__;

$header = <<<'EOF'
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.

Copyright (c) {{YEAR}} {{OWNER}} {{EMAIL}}

For the full copyright and license information, please view the LICENSE.MD
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'assets',
        'bin',
        'config',
        'migrations',
        'public',
        'var',
        'vendor',
    ])
    ->in(["{$projectDirectory}/src", "{$projectDirectory}/tests"])
    ->ignoreDotFiles(true)
    ->notName(['*Configuration*'])
    ->in($projectDirectory)
;

$rules = [
    '@PSR2' => true,
    '@PSR12' => true,
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PhpCsFixer' => true,
    '@PHP80Migration' => true,
    '@PHP80Migration:risky' => true,
    '@PHP81Migration' => true,
    '@PHP82Migration' => true,
    '@PHP83Migration' => true,
    '@PHPUnit100Migration:risky' => true,
    'single_line_throw' => true,
    'date_time_immutable' => true,
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    'php_unit_internal_class' => false,
    'phpdoc_align' => ['align' => 'left'],
    'php_unit_test_class_requires_covers' => false,
    'php_unit_test_case_static_method_calls' => false,
    'operator_linebreak' => ['position' => 'beginning'],
    'curly_braces_position' => ['anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end'],
    'phpdoc_line_span' => ['const' => 'single', 'property' => 'single', 'method' => 'single'],
    'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true],
    'header_comment' => [
        'comment_type' => 'PHPDoc',
        'header' => str_replace(
            ['{{YEAR}}', '{{OWNER}}', '{{EMAIL}}'],
            [$year, $owner, $email],
            $header,
        ),
        'location' => 'after_declare_strict',
        'separate' => 'top',
    ],
];

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder)
;
