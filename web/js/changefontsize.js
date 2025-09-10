var Cookie = "fontSize";
$(document).ready(function () {
  removeSeleted();
  var fontsize = $.cookie(Cookie) || "normal";
  if (fontsize == "normal") {
    $("html").css("font-size", "100%");
    $(".fontSize .defaultFont").addClass("selected");
  } else if (fontsize == "larger") {
    $("html").css("font-size", "110%");
    $(".fontSize .largerFont").addClass("selected");
  } else if (fontsize == "biggest") {
    $("html").css("font-size", "125%");
    $(".fontSize .xLargerFont").addClass("selected");
  }
});
function normalFont() {
  removeSeleted();
  $("html").css("font-size", "100%");
  $(".fontSize .defaultFont").addClass("selected");
  fontsize = "normal";
  $.cookie(Cookie, fontsize, {
    expires: 7,
    path: "/",
  });
}
function largerFont() {
  removeSeleted();
  $("html").css("font-size", "110%");
  $(".fontSize .largerFont").addClass("selected");
  fontsize = "larger";
  $.cookie(Cookie, fontsize, {
    expires: 7,
    path: "/",
  });
}
function biggestFont() {
  removeSeleted();
  $("html").css("font-size", "125%");
  $(".fontSize .xLargerFont").addClass("selected");
  fontsize = "biggest";
  $.cookie(Cookie, fontsize, {
    expires: 7,
    path: "/",
  });
}
function removeSeleted() {
  $(".fontSize .defaultFont").removeClass("selected");
  $(".fontSize .largerFont").removeClass("selected");
  $(".fontSize .xLargerFont").removeClass("selected");
}
