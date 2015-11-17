//Everything concerning the menu
(function ($) {

    $.fn.menumaker = function (options) {

        var cssmenu = $(this), settings = $.extend({
            title: "<span style='color: orangered'>+</span>vonbülow.co",
            format: "dropdown",
            sticky: false
        }, options);

        return this.each(function () {
            cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
            $(this).find("#menu-button").on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.hide().removeClass('open');
                }
                else {
                    mainmenu.show().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });

            $(".has-sub").append('<span class="submenu-button"></span>');
            $('.submenu-button').click(function () {
                $(this).toggleClass('submenu-opened');
                if ($(this).siblings('ul').hasClass('open')) {
                    $(this).siblings('ul').removeClass('open').hide();
                }
                else {
                    $(this).siblings('ul').addClass('open').show();
                }
            });
        });
    };
})(jQuery);

(function ($) {
    $(document).ready(function () {

        $(document).ready(function () {
            $("#cssmenu").menumaker({
                title: "<span style='color: orangered'>+</span>vonbülow.co",
                format: "multitoggle"
            });

            $("#cssmenu").prepend("<div id='menu-line'></div>");

            var found = false, activeElement, linePosition = 0, menuLine = $("#cssmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

            $("#cssmenu > ul > li").each(function () {
                if ($(this).hasClass('active')) {
                    activeElement = $(this);
                    foundActive = true;
                }
            });

            if (foundActive === false) {
                activeElement = $("#cssmenu > ul > li").first();
            }

            defaultWidth = lineWidth = activeElement.width();

            defaultPosition = linePosition = activeElement.position().left;

            menuLine.css("width", lineWidth);
            menuLine.css("left", linePosition);

            $("#cssmenu > ul > li").hover(function () {
                activeElement = $(this);
                lineWidth = activeElement.width();
                linePosition = activeElement.position().left;
                menuLine.css("width", lineWidth);
                menuLine.css("left", linePosition);
            },
                    function () {
                        menuLine.css("left", defaultPosition);
                        menuLine.css("width", defaultWidth);
                    });

        });


    });
})(jQuery);
