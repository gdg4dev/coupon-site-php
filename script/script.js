
setInterval(() => {
  if($(window).width() < 768){
    $("#nav-head-close-btn").css("visibility","visible")
    if($("#sidebar").hasClass("active")){
      $(".wrapper").addClass("sidebar-is-active")
    } else {
      $(".sidebar-is-active").removeClass("sidebar-is-active")    
    }
    $("#dismiss").css("display","block")
  } else {
    $("#nav-head-close-btn").css("visibility","hidden")
    $("#dismiss").css("display","none")
  }

}, 1000);

$(document).ready(function () {
  $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
      $(this).toggleClass('active');
  });
  $('#dismiss').on('click', function () {
    $('#sidebar').toggleClass('active');
    $(this).toggleClass('active');
});
});


$(window).on('load',function() {
  $("body").fadeIn(1000);
  setTimeout(function(){
    $('#cat-btn-lnk').trigger('click');
  },1000);
});