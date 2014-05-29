;(function(window, $) {

  window.markAsRequired = function(el) {
    var id = $(el).attr("id");
    $("label[for='" + id + "']").addClass("label-required");
  };

})(window, jQuery);

$(function() {

  window.validator = new FormValidator();
  window.validator.defineValidation('production_id', /\d{4}-\d{4}/, 'Forestillings nummber ikke gyldigt');

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

  $("select.power-select").chosen();

});
