<?php
namespace Drupal\g2\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Autocomplete implements ContainerInjectionInterface {
    public static function create(ContainerInterface $container): static {
        $configFactory = $container->get(G2::SVC_CONF);
        return new static($configFactory);
    }
}
?>
-----
<?php
namespace Drupal\g2\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Autocomplete implements ContainerInjectionInterface {
    public static function create(ContainerInterface $container): static {
        $configFactory = $container->get(G2::SVC_CONF);
        return new static($configFactory);
    }
}
?>
