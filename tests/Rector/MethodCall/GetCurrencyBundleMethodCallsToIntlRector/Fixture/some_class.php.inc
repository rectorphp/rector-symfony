<?php

namespace Rector\Tests\Naming\Rector\MethodCall\GetCurrencyBundleMethodCallsToIntlRector\Fixture;

$currencyBundle = \Symfony\Component\Intl\Intl::getCurrencyBundle();

$currencyNames = $currencyBundle->getCurrencyNames();

?>
-----
<?php

namespace Rector\Tests\Naming\Rector\MethodCall\GetCurrencyBundleMethodCallsToIntlRector\Fixture;

$currencyBundle = \Symfony\Component\Intl\Intl::getCurrencyBundle();

$currencyNames = \Symfony\Component\Intl\Currencies::getNames();

?>
