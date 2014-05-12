;(function(window, $) {

  window.toggleAdvancedSearch = function(e) {
    e.preventDefault();
    $(".advanced-search").toggleClass("hide");
  };

})(window, jQuery);

$(function() {

  $(document).delegate(".js-toggle-advanced-search", "click", toggleAdvancedSearch);

});
