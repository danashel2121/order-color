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

namespace Nivys\OrderStatusColor\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\Status\Collection as OrderStatusCollection;

class StatusColumn extends Select
{
    /** @var OrderStatusCollection  */
    private OrderStatusCollection $orderStatusCollection;

    /**
     * @param Context $context
     * @param OrderStatusCollection $orderStatusCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        OrderStatusCollection $orderStatusCollection,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->orderStatusCollection = $orderStatusCollection;
    }

    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName(string $value): StatusColumn
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputId(string $value): StatusColumn
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    /**
     * Get colors source array
     *
     * @return array
     */
    private function getSourceOptions(): array
    {
        return $this->orderStatusCollection->toOptionArray();
    }
}
