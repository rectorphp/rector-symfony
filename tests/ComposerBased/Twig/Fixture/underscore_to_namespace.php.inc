<?php

final class SomeTwigUse
{
    public function run(Twig_Environment $twigEnvironment)
    {
        return new Twig_SimpleFilter('some_filter', 'strlen');
    }
}

?>
-----
<?php

final class SomeTwigUse
{
    public function run(\Twig\Environment $twigEnvironment)
    {
        return new \Twig\TwigFilter('some_filter', 'strlen');
    }
}

?>
