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

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\BlockInterface;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Nivys\OrderStatusColor\Block\Adminhtml\Blocks\Edit\Tab\ColorRenderer;

class Colors extends AbstractFieldArray
{
    /** @var StatusColumn */
    protected StatusColumn $statusColumn;

    /** @var ColorRenderer */
    protected ColorRenderer $colorRenderer;

    /**
     * @param Context $context
     * @param StatusColumn $statusColumn
     * @param ColorRenderer $colorRenderer
     * @param SecureHtmlRenderer|null $secureRenderer
     * @param array $data
     */
    public function __construct(
        Context $context,
        StatusColumn $statusColumn,
        ColorRenderer $colorRenderer,
        ?SecureHtmlRenderer $secureRenderer = null,
        array $data = []
    ) {
        parent::__construct($context, $data, $secureRenderer);
        
        $this->statusColumn = $statusColumn;
        $this->colorRenderer = $colorRenderer;
    }

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('status', [
            'label' => __('Order Status'),
            'renderer' => $this->getStatusRenderer()
        ]);

        $this->addColumn('color', [
            'label' => __('Color'),
            'renderer' => $this->getColorRenderer()
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Get status renderer block
     *
     * @return StatusColumn
     * @throws LocalizedException
     */
    private function getStatusRenderer(): StatusColumn
    {
        if (!$this->statusColumn) {
            $this->statusColumn = $this->getLayout()->createBlock(
                StatusColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }

        return $this->statusColumn;
    }

    /**
     * Get color renderer block
     *
     * @return ColorRenderer&BlockInterface
     * @throws LocalizedException
     */
    private function getColorRenderer()
    {
        if (!$this->colorRenderer) {
            $this->colorRenderer = $this->getLayout()->createBlock(
                ColorRenderer::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->colorRenderer;
    }
}
