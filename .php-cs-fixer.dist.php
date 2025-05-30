<?php

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/config'
    ])
    ->exclude([
        'vendor',  // Asegúrate de que 'vendor' esté excluido
        'var',
        'public/bundles',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'yoda_style' => false,  // Disallow Yoda Style
        'doctrine_annotation_array_assignment' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
