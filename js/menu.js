$(document).ready(function() {

    // Evento de mostrar y ocultar menú
    $("#btn-menu").click(function() {
      if ($("#btn-menu").attr("class") == "fa fa-bars") {
        $("#btn-menu").removeClass("fa fa-bars").addClass("fas fa-check-circle");
        $(".menu").css({"left": "5%"});
        $(".menu").css({"width": "100%"}); // Asegúrate de que sea 'width' no 'widht'
      } else {
        $("#btn-menu").removeClass("fas fa-check-circle").addClass("fa fa-bars");
        $(".menu").css({"left": "-200%"});
      }
    });
  
    // Evento de mostrar y ocultar submenú
    $(".submenu").click(function() {
      $(this).children("ul").slideToggle();
    });
  
    // Evento para evitar la propagación del clic en el submenú
    $("ul").click(function(p) {
      p.stopPropagation(); // Corrección aquí
    });
  
    // Evento de mostrar más y menos
    $("#mensaje").hide();
    $("#readmore").click(function() {
      $("#readmore").hide();
      $("#mensaje").show("slow");
      $(".oculto").show("slow");
    });
  
    $(".oculto").click(function() {
      $("#mensaje").hide();
      $(this).hide();
      $("#readmore").show();
    });
  
  });
  