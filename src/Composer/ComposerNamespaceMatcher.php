<?php

declare(strict_types=1);

namespace Rector\Symfony\Composer;

use Nette\Utils\Strings;
use Symplify\ComposerJsonManipulator\ComposerJsonFactory;
use Symplify\SmartFileSystem\SmartFileSystem;

final class ComposerNamespaceMatcher
{
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;

    /**
     * @var ComposerJsonFactory
     */
    private $composerJsonFactory;

    public function __construct(SmartFileSystem $smartFileSystem, ComposerJsonFactory $composerJsonFactory)
    {
        $this->smartFileSystem = $smartFileSystem;
        $this->composerJsonFactory = $composerJsonFactory;
    }

    public function matchNamespaceForLocation(string $path): ?string
    {
        $composerJsonFilePath = getcwd() . '/composer.json';
        if (! $this->smartFileSystem->exists($composerJsonFilePath)) {
            return null;
        }

        $composerJson = $this->composerJsonFactory->createFromFilePath($composerJsonFilePath);
        $autoload = $composerJson->getAutoload();
        foreach ($autoload['psr-4'] ?? [] as $namespace => $directory) {
            if (! is_array($directory)) {
                $directory = [$directory];
            }

            foreach ($directory as $singleDirectory) {
                if (! Strings::startsWith($path, $singleDirectory)) {
                    continue;
                }

                return rtrim($namespace, '\\');
            }
        }

        return null;
    }
}
