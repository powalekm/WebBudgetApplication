var xValues = ["Food", "Transport", "Others", "Rental", "Relax"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Summary in total: 1200zł"
    }
  }
});

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

  function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";
    }
  }
