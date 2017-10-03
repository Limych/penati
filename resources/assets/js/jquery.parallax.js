/*
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

(function( $ ){
    var $window = $(window);

    $.fn.parallax = function (speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var isWebkitTransform = (typeof document.body.style['-webkit-transform'] !== "undefined");
        if (isWebkitTransform) {
            $this.css('position', 'relative');
        }

        if (arguments.length < 1 || speedFactor === null) {
            speedFactor = 0.8;
        }
        if (arguments.length < 2 || outerHeight === null) {
            outerHeight = true;
        }

        if (outerHeight) {
            getHeight = function (jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function (jqo) {
                return jqo.height();
            };
        }

        function update() {
            var pos = $window.scrollTop;
            var windowHeight = $window.height();
            $this.each(function () {
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);
                var rect = this.getBoundingClientRect();
                if (top + height < pos || top > pos + windowHeight) {
                    return;
                }
                var backgroundVerticalShift = -1 * Math.round(rect.top * speedFactor);
                if (isWebkitTransform) {
                    this.style['-webkit-transform'] = "translateY(" + backgroundVerticalShift + "px)";
                } else {
                    this.style.top = backgroundVerticalShift + "px";
                }
            })
        }

        $window.bind('scroll', update).resize(update);
        if (document.readyState !== "complete") {
            window.addEventListener('load', function () {
                update();
            })
        } else {
            update();
        }
    };
}( jQuery ));

