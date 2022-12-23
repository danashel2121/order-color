define([
    'underscore',
    'Magento_Ui/js/grid/columns/select',
], function(_, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Nivys_OrderStatusColor/ui/grid/cells/status',
        },

        getDynamicTextColor(hex) {
            if (hex == 'transparent') {
                return '#303030';
            }

            return this._shouldTextBeBlack(hex) ? '#303030' : '#ffffff';
        },

        _shouldTextBeBlack(backgroundcolor) {
            return this._computeLuminence(backgroundcolor) > 0.179;
        },

        _computeLuminence(backgroundcolor) {
            var colors = this._hexToRgb(backgroundcolor);

            var components = ['r', 'g', 'b'];
            for (var i in components) {
                var c = components[i];

                colors[c] = colors[c] / 255.0;

                if (colors[c] <= 0.03928) {
                    colors[c] = colors[c] / 12.92;
                } else {
                    colors[c] = Math.pow(((colors[c] + 0.055) / 1.055), 2.4);
                }
            }

            var luminence = 0.2126 * colors.r + 0.7152 * colors.g + 0.0722 *
                colors.b;

            return luminence;
        },

        _hexToRgb(hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16),
            } : null;
        },
    });
});