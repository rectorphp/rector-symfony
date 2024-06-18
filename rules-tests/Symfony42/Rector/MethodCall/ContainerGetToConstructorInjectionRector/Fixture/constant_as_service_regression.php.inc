<?php

declare(strict_types=1);

namespace Drupal\g2\Controller;

use Drupal\Core\Cache\CacheableJsonResponse;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
//use Drupal\g2\G2;
use Drupal\g2\RouteFilter;
use Drupal\g2\WOTD;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class G2 {

    const SVC_CONF = 'config.factory';

    const SVC_ETM = 'entity.manager';

    const SVC_ROUTE_FILTER = 'g2.route_filter';

    const SVC_WOTD = 'g2.wotd';

}

/**
 * Class Autocomplete contains the node by title autocomplete controller.
 *
 * @phpstan-consistent-constructor
 */
class Autocomplete implements ContainerInjectionInterface {
    use StringTranslationTrait;

    /**
     * The core config.factory service.
     *
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected ConfigFactoryInterface $configFactory;

    /**
     * The core entity.manager service.
     *
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $etm;

    /**
     * The g2.route_filter service.
     *
     * @var \Drupal\g2\RouteFilter
     */
    protected RouteFilter $routeFilter;

    /**
     * The g2.wotd service.
     *
     * @var \Drupal\g2\WOTD
     */
    protected WOTD $wotd;

    /**
     * Autocomplete constructor.
     *
     * @param \Drupal\Core\Entity\EntityTypeManagerInterface $etm
     *   The entity.manager service.
     * @param \Drupal\g2\RouteFilter $routeFilter
     *   The g2.route_filter service.
     * @param \Drupal\g2\WOTD $wotd
     *   The g2.wotd service.
     * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
     *   The g2.settings/controller.homonyms configuration.
     */
    public function __construct(EntityTypeManagerInterface $etm, RouteFilter $routeFilter, WOTD $wotd, ConfigFactoryInterface $configFactory) {
        $this->configFactory = $configFactory;
        $this->etm = $etm;
        $this->routeFilter = $routeFilter;
        $this->wotd = $wotd;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container): static {
        /** @var \Drupal\Core\Config\ConfigFactoryInterface $configFactory */
        $configFactory = $container->get(G2::SVC_CONF);

        /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager */
        $entity_manager = $container->get(G2::SVC_ETM);

        /** @var \Drupal\g2\RouteFilter $rf */
        $rf = $container->get(G2::SVC_ROUTE_FILTER);

        /** @var \Drupal\g2\WOTD $wotd */
        $wotd = $container->get(G2::SVC_WOTD);

        return new static($entity_manager, $rf, $wotd, $configFactory);
    }
}
?>
-----
<?php

declare(strict_types=1);

namespace Drupal\g2\Controller;

use Drupal\Core\Cache\CacheableJsonResponse;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
//use Drupal\g2\G2;
use Drupal\g2\RouteFilter;
use Drupal\g2\WOTD;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class G2 {

    const SVC_CONF = 'config.factory';

    const SVC_ETM = 'entity.manager';

    const SVC_ROUTE_FILTER = 'g2.route_filter';

    const SVC_WOTD = 'g2.wotd';

}

/**
 * Class Autocomplete contains the node by title autocomplete controller.
 *
 * @phpstan-consistent-constructor
 */
class Autocomplete implements ContainerInjectionInterface {
    use StringTranslationTrait;

    /**
     * The core config.factory service.
     *
     * @var \Drupal\Core\Config\ConfigFactoryInterface
     */
    protected ConfigFactoryInterface $configFactory;

    /**
     * The core entity.manager service.
     *
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $etm;

    /**
     * The g2.route_filter service.
     *
     * @var \Drupal\g2\RouteFilter
     */
    protected RouteFilter $routeFilter;

    /**
     * The g2.wotd service.
     *
     * @var \Drupal\g2\WOTD
     */
    protected WOTD $wotd;

    /**
     * Autocomplete constructor.
     *
     * @param \Drupal\Core\Entity\EntityTypeManagerInterface $etm
     *   The entity.manager service.
     * @param \Drupal\g2\RouteFilter $routeFilter
     *   The g2.route_filter service.
     * @param \Drupal\g2\WOTD $wotd
     *   The g2.wotd service.
     * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
     *   The g2.settings/controller.homonyms configuration.
     */
    public function __construct(EntityTypeManagerInterface $etm, RouteFilter $routeFilter, WOTD $wotd, ConfigFactoryInterface $configFactory) {
        $this->configFactory = $configFactory;
        $this->etm = $etm;
        $this->routeFilter = $routeFilter;
        $this->wotd = $wotd;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container): static {
        /** @var \Drupal\Core\Config\ConfigFactoryInterface $configFactory */
        $configFactory = $container->get(G2::SVC_CONF);

        /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager */
        $entity_manager = $container->get(G2::SVC_ETM);

        /** @var \Drupal\g2\RouteFilter $rf */
        $rf = $container->get(G2::SVC_ROUTE_FILTER);

        /** @var \Drupal\g2\WOTD $wotd */
        $wotd = $container->get(G2::SVC_WOTD);

        return new static($entity_manager, $rf, $wotd, $configFactory);
    }
}
?>
