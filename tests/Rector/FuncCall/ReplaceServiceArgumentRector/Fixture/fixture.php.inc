<?php

function constraintUrlOptionRector()
{
    $value = \Symfony\Component\DependencyInjection\Loader\Configurator\service(\Psr\Container\ContainerInterface::class);
}

?>
-----
<?php

function constraintUrlOptionRector()
{
    $containt = new Url(['checkDNS' => \Symfony\Component\Validator\Constraints\Url::CHECK_DNS_TYPE_ANY]);
}

?>
