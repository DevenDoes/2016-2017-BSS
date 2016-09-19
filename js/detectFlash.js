function hasFlash() {
  try {
    return Boolean(new ActiveXObject('ShockwaveFlash.ShockwaveFlash'));
  } catch (exception) {
    return ('undefined' != typeof navigator.mimeTypes['application/x-shockwave-flash']);
  }
}

document.addEventListener("DOMContentLoaded", function (event) {
  if (!hasFlash()) {
    var replaceString = '<div class="container" style="text-align: center;"><h1>Read the Broad Street Scientific <a href="http://issuu.com/broadstreetscientificpublication/docs/bss_2014-2015_final">here</a>.</h1></container>';
    $("#flashcontent").replaceWith(replaceString);
    $("#journal").css("background", "#2C3E50");
    $("#journal").css("height", "200px");
  }
});