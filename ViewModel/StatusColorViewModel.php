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

namespace Nivys\OrderStatusColor\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Nivys\OrderStatusColor\Model\StatusColor;

class StatusColorViewModel implements ArgumentInterface
{
    /** @var StatusColor */
    protected StatusColor $statusColor;

    /**
     * @param StatusColor $statusColor
     */
    public function __construct(
        StatusColor $statusColor
    ) {
        $this->statusColor = $statusColor;
    }

    /**
     * Get color based on status code
     *
     * @param string $statusCode
     * @return string
     */
    public function getColor(string $statusCode): string
    {
        return $this->statusColor->getColor($statusCode);
    }
}
