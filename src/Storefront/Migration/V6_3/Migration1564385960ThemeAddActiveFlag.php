<?php declare(strict_types=1);

namespace Shopware\Storefront\Migration\V6_3;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @deprecated tag:v6.5.0 - reason:becomes-internal - Migrations will be internal in v6.5.0
 */
class Migration1564385960ThemeAddActiveFlag extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1564385960;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement('ALTER TABLE `theme` ADD `active` TINYINT(1) NOT NULL DEFAULT 1 AFTER `config_values`;');
        $connection->executeStatement('
            UPDATE `media_default_folder` SET `association_fields` = \'[\"media\"]\' WHERE `entity` = \'theme\';
        ');
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
