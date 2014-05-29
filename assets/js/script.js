;(function(window, $) {

  window.markAsRequired = function(el) {
    var id = $(el).attr("id");
    $("label[for='" + id + "']").addClass("label-required");
  };

})(window, jQuery);

$(function() {

  window.validator = new FormValidator();

  window.toSentence.and = "og";

  $('form.validate').validate({
    validator: validator,
    selectorClasses: { field: '.form-group' },
    errorClasses:    { field: 'has-error'   },
    errorMessages: {
      required: "Skal være udfyldt",
      number: "Skal være tal"
    }
  });

  $(".sortable").tablesorter();

  $('[data-validation*="required"]').each(function(_i, el) {
    window.markAsRequired(el);
  });

});
