const toggleMenus = () => {
    if ($("#header").hasClass("submenu_hidded")) {
        $("#burgermenu_top").hide();
        $("#logo_link").hide();
        $("#header_nav").show().css("width", "100%");
        $("#sign_in").show();
        $("#header").css("flex-direction", "column")
        $("#sign_in").css({
            "width": "100%",
            "text-align": "center"
        })
        $("#nav_list").css({
            "height": "4rem",
            "justify-content": "space-evenly"
        }).show()
        $("#nav_list").find("li").css("margin-right", "0")

        $("#drop_down-main").show();
        $("#header").removeClass("submenu_hidded")
        $("#google_translate_element").hide()

    }

    else {
        $("#sign_in").hide();
        $("#nav_list").hide();
        $("#burgermenu_top").show();
        $("#logo_link").show();
        $("#header").css("flex-direction", "row")

        $("#drop_down-main").hide();
        $("#header").addClass("submenu_hidded")
        $("#google_translate_element").show()


    }

}