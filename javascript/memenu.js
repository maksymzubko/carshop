$.fn.memenu = function (e) {
    function r() {
        $(".memenu main").find("li, a").unbind();
        $(".memenu filters").find("li, a").unbind();
        if (window.innerWidth <= 768) {
            o1(); s1();
            if (n == 0) {
                $(".filters > li:not(.showhide)").hide(0);
                $(".main > li:not(.showhide)").hide(0);
            }
        }
        else { u1(); i1() }
    }

    function i1() {
        $(".main li").bind("mouseover", function () {
            $(this).children(".dropdown, .mepanel").stop().fadeIn(t.interval)
        }).bind("mouseleave", function () {
            $(this).children(".dropdown, .mepanel").stop().fadeOut(t.interval)
        })

        $(".filters li").bind("mouseover", function () {
            $(this).children(".dropdown, .mepanel").stop().fadeIn(t.interval)
        }).bind("mouseleave", function () {
            $(this).children(".dropdown, .mepanel").stop().fadeOut(t.interval)
        })
    }

    function s1() {
        //main menu
        $(".main > li > a").bind("click", function (e) {
            if ($(this).siblings(".dropdown, .mepanel").css("display") == "none") {
                $(this).siblings(".dropdown, .mepanel").slideDown(t.interval);
                $(this).siblings(".dropdown").find("ul").slideDown(t.interval);
                n = 1
            }
            else {
                $(this).siblings(".dropdown, .mepanel").slideUp(t.interval)
            }
        })

        //filters
        $(".filters > li > a").bind("click", function (e) {
            if ($(this).siblings(".dropdown, .mepanel").css("display") == "none") {
                $(this).siblings(".dropdown, .mepanel").slideDown(t.interval);
                $(this).siblings(".dropdown").find("ul").slideDown(t.interval);
                n = 1
            }
            else {
                $(this).siblings(".dropdown, .mepanel").slideUp(t.interval)
            }
        })
    }

    function o1() {
        $(".main > li.showhide").show(0);
        $(".filters > li.showhide").show(0);
        //main menu
        $(".main > li.showhide").bind("click", function () {
            if ($(".main > li").is(":hidden")) {
                $(".main > li").slideDown(300)
            }
            else {
                $(".main > li:not(.showhide)").slideUp(300);
                $(".main > li.showhide").show(0)
            }
        })

        //filters
        $(".filters > li.showhide").bind("click", function () {
            if ($(".filters > li").is(":hidden")) {
                $(".filters > li").slideDown(300)
            }
            else {
                $(".filters > li:not(.showhide)").slideUp(300);
                $(".filters > li.showhide").show(0)
            }
        })
    }

    function u1() {
        $(".main > li").show(0);
        $(".main > li.showhide").hide(0);

        $(".filters > li").show(0);
        $(".filters > li.showhide").hide(0);
    }

    var t = { interval: 250 };
    var n = 0;
    $(".main").prepend("<li class='showhide'><span class='title'>Menu</span><span class='icon1'></span><span class='icon2'></span></li>");
    $(".filters").prepend("<li class='showhide'><span class='title'>Filters</span><span class='icon1'></span><span class='icon2'></span></li>");
    r();

    $(window).resize(function () { r() })
}

