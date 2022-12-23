<?php
/**
 * This file is part of the Nivys_OrderStatusColor package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Nivys_OrderStatusColor
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2022 Nivys, Ltd. (https://nivys.com/)
 * @author    Nivys <info@nivys.com>
 * @license   MIT
 */

namespace Nivys\OrderStatusColor\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Nivys\OrderStatusColor\Model\StatusColor;

class StatusColorViewModel implements ArgumentInterface
{
    private StatusColor $statusColor;

    public function __construct(
        StatusColor $statusColor
    ) {
        $this->statusColor = $statusColor;
    }

    public function getColor(string $statusCode): string
    {
        return $this->statusColor->getColor($statusCode);
    }
}
