<?php

namespace Nivys\OrderStatusColor\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json as Serialize;
use Magento\Store\Model\ScopeInterface;

class StatusColor
{
    public const STATUS_COLOR_CONFIG_PATH = 'sales/order_status_color/colors';
    public const DEFAULT_COLOR = 'transparent';

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