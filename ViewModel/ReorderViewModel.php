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
use Magento\Sales\Helper\Reorder;

class ReorderViewModel implements ArgumentInterface
{
    /** @var Reorder */
    protected Reorder $reorder;

    /**
     * @param Reorder $reorder
     */
    public function __construct(
        Reorder $reorder
    ) {
        $this->reorder = $reorder;
    }

    /**
     * @return bool
     */
    public function isAllow(): bool
    {
        return $this->reorder->isAllow();
    }

    /**
     * @param int $orderId
     * @return bool
     */
    public function canReorder(int $orderId): bool
    {
        return $this->reorder->canReorder($orderId);
    }
}
