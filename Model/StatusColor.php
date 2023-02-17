<?php
/**
 * This file is part of the Nivys OrderStatusColor package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this package
 * to newer versions in the future.
 *
 * @author   Nivys <info.nivys@gmail.com>
 * @license  GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Nivys\OrderStatusColor\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json as Serialize;
use Magento\Store\Model\ScopeInterface;

class StatusColor
{
    public const STATUS_COLOR_CONFIG_PATH = 'order_status_color/general/colors';
    public const DEFAULT_COLOR = 'transparent';

    /** @var string|null */
    private ?string $colorConfigs = null;

    /** @var ScopeConfigInterface */
    private ScopeConfigInterface $scopeConfig;

    /** @var Serialize */
    private Serialize $serialize;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param Serialize $serialize
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Serialize $serialize
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->serialize = $serialize;
    }

    /**
     * Get color based on status code
     *
     * @param string $statusCode
     * @return string
     */
    public function getColor(string $statusCode): string
    {
        $configArray = $this->getColorConfigs();

        if (!$configArray) {
            return self::DEFAULT_COLOR;
        }

        foreach ($this->serialize->unserialize($configArray) as $item) {
            if ($item['status'] !== $statusCode) {
                continue;
            }

            return $item['color'];
        }

        return self::DEFAULT_COLOR;
    }

    /**
     * Get cached color config
     *
     * @return ?string
     */
    public function getColorConfigs(): ?string
    {
        if (!$this->colorConfigs) {
            $this->colorConfigs = $this->scopeConfig->getValue(
                self::STATUS_COLOR_CONFIG_PATH,
                ScopeInterface::SCOPE_STORES
            );
        }

        return $this->colorConfigs;
    }
}
