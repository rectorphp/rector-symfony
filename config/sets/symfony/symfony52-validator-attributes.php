<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

// @see https://symfony.com/blog/new-in-symfony-5-2-constraints-as-php-attributes
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline([
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Bic',
                    'Symfony\Component\Validator\Constraints\Bic'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Blank',
                    'Symfony\Component\Validator\Constraints\Blank'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Callback',
                    'Symfony\Component\Validator\Constraints\Callback'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\CardScheme',
                    'Symfony\Component\Validator\Constraints\CardScheme'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Cascade',
                    'Symfony\Component\Validator\Constraints\Cascade'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Choice',
                    'Symfony\Component\Validator\Constraints\Choice'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Count',
                    'Symfony\Component\Validator\Constraints\Count'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Country',
                    'Symfony\Component\Validator\Constraints\Country'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Currency',
                    'Symfony\Component\Validator\Constraints\Currency'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Date',
                    'Symfony\Component\Validator\Constraints\Date'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\DateTime',
                    'Symfony\Component\Validator\Constraints\DateTime'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\DisableAutoMapping',
                    'Symfony\Component\Validator\Constraints\DisableAutoMapping'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\DivisibleBy',
                    'Symfony\Component\Validator\Constraints\DivisibleBy'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Email',
                    'Symfony\Component\Validator\Constraints\Email'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\EnableAutoMapping',
                    'Symfony\Component\Validator\Constraints\EnableAutoMapping'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\EqualTo',
                    'Symfony\Component\Validator\Constraints\EqualTo'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Expression',
                    'Symfony\Component\Validator\Constraints\Expression'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\ExpressionLanguageSyntax',
                    'Symfony\Component\Validator\Constraints\ExpressionLanguageSyntax'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\File',
                    'Symfony\Component\Validator\Constraints\File'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\GreaterThan',
                    'Symfony\Component\Validator\Constraints\GreaterThan'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\GreaterThanOrEqual',
                    'Symfony\Component\Validator\Constraints\GreaterThanOrEqual'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\GroupSequence',
                    'Symfony\Component\Validator\Constraints\GroupSequence'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\GroupSequenceProvider',
                    'Symfony\Component\Validator\Constraints\GroupSequenceProvider'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Hostname',
                    'Symfony\Component\Validator\Constraints\Hostname'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Iban',
                    'Symfony\Component\Validator\Constraints\Iban'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\IdenticalTo',
                    'Symfony\Component\Validator\Constraints\IdenticalTo'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Image',
                    'Symfony\Component\Validator\Constraints\Image'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Ip',
                    'Symfony\Component\Validator\Constraints\Ip'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Isbn',
                    'Symfony\Component\Validator\Constraints\Isbn'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\IsFalse',
                    'Symfony\Component\Validator\Constraints\IsFalse'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Isin',
                    'Symfony\Component\Validator\Constraints\Isin'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\IsNull',
                    'Symfony\Component\Validator\Constraints\IsNull'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Issn',
                    'Symfony\Component\Validator\Constraints\Issn'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\IsTrue',
                    'Symfony\Component\Validator\Constraints\IsTrue'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Json',
                    'Symfony\Component\Validator\Constraints\Json'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Language',
                    'Symfony\Component\Validator\Constraints\Language'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Length',
                    'Symfony\Component\Validator\Constraints\Length'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\LessThan',
                    'Symfony\Component\Validator\Constraints\LessThan'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\LessThanOrEqual',
                    'Symfony\Component\Validator\Constraints\LessThanOrEqual'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Locale',
                    'Symfony\Component\Validator\Constraints\Locale'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Luhn',
                    'Symfony\Component\Validator\Constraints\Luhn'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Negative',
                    'Symfony\Component\Validator\Constraints\Negative'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NegativeOrZero',
                    'Symfony\Component\Validator\Constraints\NegativeOrZero'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NotBlank',
                    'Symfony\Component\Validator\Constraints\NotBlank'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NotCompromisedPassword',
                    'Symfony\Component\Validator\Constraints\NotCompromisedPassword'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NotEqualTo',
                    'Symfony\Component\Validator\Constraints\NotEqualTo'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NotIdenticalTo',
                    'Symfony\Component\Validator\Constraints\NotIdenticalTo'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\NotNull',
                    'Symfony\Component\Validator\Constraints\NotNull'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Positive',
                    'Symfony\Component\Validator\Constraints\Positive'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\PositiveOrZero',
                    'Symfony\Component\Validator\Constraints\PositiveOrZero'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Range',
                    'Symfony\Component\Validator\Constraints\Range'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Regex',
                    'Symfony\Component\Validator\Constraints\Regex'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Time',
                    'Symfony\Component\Validator\Constraints\Time'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Timezone',
                    'Symfony\Component\Validator\Constraints\Timezone'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Traverse',
                    'Symfony\Component\Validator\Constraints\Traverse'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Type',
                    'Symfony\Component\Validator\Constraints\Type'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Ulid',
                    'Symfony\Component\Validator\Constraints\Ulid'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Unique',
                    'Symfony\Component\Validator\Constraints\Unique'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Url',
                    'Symfony\Component\Validator\Constraints\Url'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Uuid',
                    'Symfony\Component\Validator\Constraints\Uuid'
                ),
                new AnnotationToAttribute(
                    'Symfony\Component\Validator\Constraints\Valid',
                    'Symfony\Component\Validator\Constraints\Valid'
                ),
            ]),
        ]]);
};
