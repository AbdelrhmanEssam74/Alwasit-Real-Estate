$(document).ready(function () {
  var sort_by = $(".sort_by_btn");
  var sort_list = $(".sort_list");
  var sort_links = $(".sort_list a");
  var sort_by_overlay = $(".sort-by-overlay");

  if (sort_by.length) {
    sort_by.on("click", function () {
      sort_list.toggleClass("show_list");
      sort_by_overlay.toggleClass("show");
    });
  }


  sort_by_overlay.on("click", function () {
    if (sort_list.length && sort_list.hasClass("show_list")) {
      sort_list.removeClass("show_list");
      sort_by_overlay.removeClass("show");
    }
  });

  setTimeout(function () {
    if (sort_list.length && sort_list.hasClass("show_list")) {
      sort_list.removeClass("show_list");
    }
  }, 5000);
});
