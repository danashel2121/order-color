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

namespace Nivys\OrderStatusColor\Block\Adminhtml\Blocks\Edit\Tab;

use Magento\Framework\View\Element\AbstractBlock;

class ColorRenderer extends AbstractBlock
{
    /**
     * Adding javascript for color picker jQuery
     *
     * @return string
     */
    public function _toHtml(): string
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '" >';
        $html .= '<script type="text/javascript">
                require(["jquery","jquery/colorpicker/js/colorpicker"], function ($, colorPicker) {
                    $(document).ready(function () {
                        var $el = $("#'.$this->getInputId().'");
                        $el.css("background", $el.val());

                        // Attach the color picker
                        $el.ColorPicker({
                            onChange: function (hsb, hex, rgb) {
                                $el.css("backgroundColor", "#" + hex).val("#" + hex);
                            }
                        });
                    });
                });
                </script>';

        return $html;
    }
}
