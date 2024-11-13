function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

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
      text: "Expense Categories:"
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

  var periodSelectorChange = function(selection) {
    $('#floatingDatePeriod').val(selection);
};

function dateFilter() {
  var currentDate = new Date();
  var firstDayOfMonth, lastDayofMonth;

  if ($("#floatingDatePeriod").val() == 1){
    firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 2);
    $("#floatingStartDate").attr('value', firstDayOfMonth.toISOString().substring(0,10));
    $("#floatingEndDate").attr('value',  currentDate.toISOString().substring(0,10));
  } else if ($("#floatingDatePeriod").val() == 2){
    firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 2);
    lastDayofMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    $("#floatingStartDate").attr('value', firstDayOfMonth.toISOString().substring(0,10));
    $("#floatingEndDate").attr('value',  lastDayofMonth.toISOString().substring(0,10));
  } else if ($("#floatingDatePeriod").val() == 3){
    firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() - 2, 2);
    $("#floatingStartDate").attr('value', firstDayOfMonth.toISOString().substring(0,10));
    $("#floatingEndDate").attr('value',  currentDate.toISOString().substring(0,10));
  } 
}

