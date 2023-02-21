<?php

use Symfony\Contracts\Translation\TranslatorInterface;

final class Translator implements TranslatorInterface
{
    public function trans($id, array $parameters = [], $domain = null, $locale = null): string
    {
        return 'translated';
    }

    public function getLocale(): string
    {
        return 'locale';
    }
}

?>
-----
<?php

use Symfony\Contracts\Translation\TranslatorInterface;

final class Translator implements TranslatorInterface
{
    public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null): string
    {
        return 'translated';
    }

    public function getLocale(): string
    {
        return 'locale';
    }
}

?>
