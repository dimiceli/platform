<?php declare(strict_types=1);

namespace Shopware\Core\Migration\V6_3;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @deprecated tag:v6.5.0 - reason:becomes-internal - Migrations will be internal in v6.5.0
 */
class Migration1601388975RequireFeatureSetName extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1601388975;
    }

    public function update(Connection $connection): void
    {
    }

    public function updateDestructive(Connection $connection): void
    {
        $connection->executeStatement(
            'ALTER TABLE `product_feature_set_translation` MODIFY `name` VARCHAR(255) DEFAULT \'\' NOT NULL;'
        );
    }
}
