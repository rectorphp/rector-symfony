<?php

namespace Rector\Symfony\Tests\Rector\StmtsAwareInterface\TwigBundleFilesystemLoaderToTwigRector\Fixture;

use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser;

$filesystemLoader = new FilesystemLoader(new TemplateLocator(), new TemplateParser());
$filesystemLoader->addPath(__DIR__ . '/some-directory');
$filesystemLoader->addPath(__DIR__ . '/another-directory');

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\StmtsAwareInterface\TwigBundleFilesystemLoaderToTwigRector\Fixture;

use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser;

$filesystemLoader = new \Twig\Loader\FilesystemLoader([__DIR__ . '/some-directory', __DIR__ . '/another-directory']);

?>
