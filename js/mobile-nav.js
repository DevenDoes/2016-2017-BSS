$("#nav-trigger").on("click", function () {
  $("#mobile-nav").toggleClass("open");
});

$("#mobile-nav").on("click", function () {
  $("#mobile-nav").removeClass("open");
});