<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Adapter\Asset;

use Symfony\Component\Asset\VersionStrategy\VersionStrategyInterface;

/**
 * @package core
 */
class PrefixVersionStrategy implements VersionStrategyInterface
{
    private string $prefix;

    private VersionStrategyInterface $strategy;

    public function __construct(string $prefix, VersionStrategyInterface $strategy)
    {
        $this->prefix = rtrim($prefix, '/');
        $this->strategy = $strategy;
    }

    /**
     * @return string
     */
    public function getVersion(string $path)
    {
        return $this->applyVersion($path);
    }

    /**
     * @return string
     */
    public function applyVersion(string $path)
    {
        $prefixLength = \strlen($this->prefix);

        if ($path[0] !== '/' && $path !== '\\') {
            ++$prefixLength;
            $path = $this->prefix . '/' . $path;
        } else {
            $path = $this->prefix . $path;
        }

        $appliedPath = $this->strategy->applyVersion($path);

        return substr($appliedPath, $prefixLength);
    }
}
