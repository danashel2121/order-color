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

use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PostHelperViewModel implements ArgumentInterface
{
    /** @var PostHelper */
    protected PostHelper $postHelper;

    /**
     * @param PostHelper $postHelper
     */
    public function __construct(
        PostHelper $postHelper
    ) {
        $this->postHelper = $postHelper;
    }

    /**
     * @param string $url
     * @param array $data
     * @return string
     */
    public function getPostData(string $url, array $data = []): string
    {
        return $this->postHelper->getPostData($url, $data);
    }
}
