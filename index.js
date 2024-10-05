function buttonAnimation() {
    if( $("#navbarNav").hasClass("animation") ) {

        $("#navbarNav").removeClass("animation");
        $("#nav-line-1").removeClass("animation-left");
        $("#nav-line-2").removeClass("animation-right");

    } else {
        $("#navbarNav").addClass("animation");
        $("#nav-line-1").addClass("animation-left");
        $("#nav-line-2").addClass("animation-right");  
        }
  }

function displayModal(type) {
    if (type == "signIn"){
        if( !$("#pill-login").hasClass("active") ){
            $("#pill-login").addClass("active");
            $("#pill-register").removeClass("active");
        }
        if( !$("#pill-loginpanel").hasClass("active") && !$("#pill-loginpanel").hasClass("show") ){
            $("#pill-registerpanel").removeClass("active");
            $("#pill-registerpanel").removeClass("show");
            $("#pill-loginpanel").addClass("active");
            $("#pill-loginpanel").addClass("show");
        }
    } else if (type == "register"){
        if( !$("#pill-register").hasClass("active") ){
            $("#pill-register").addClass("active");
            $("#pill-login").removeClass("active");
        }
        if( !$("#pill-registerpanel").hasClass("active") && !$("#pill-registerpanel").hasClass("show") ){
            $("#pill-loginpanel").removeClass("active");
            $("#pill-loginpanel").removeClass("show");
            $("#pill-registerpanel").addClass("active");
            $("#pill-registerpanel").addClass("show");
        }

    }else {
        alert("Else bug");
    }
}