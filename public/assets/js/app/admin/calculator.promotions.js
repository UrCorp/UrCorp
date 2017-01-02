function checkedInputs($checkbox, $elements) {
  if ($checkbox.is(':checked')) {
    $elements.prop('disabled', false);

  } else {
    $elements.val('');
    $elements.prop('disabled', true);
  }
}

$(function() {
  var $addReferringUser = $('#add_referring_user'),
      $referringUserFields = $('.referringUserField'),
      $addExpiringDate = $('#add_expiring_date'),
      $expiringDateFields = $('.expiringDateField');

  checkedInputs($addReferringUser, $referringUserFields);

  $addReferringUser.change(function() {
    var $this = $(this);

    checkedInputs($this, $referringUserFields);
  });

  checkedInputs($addExpiringDate, $expiringDateFields);

  $addExpiringDate.change(function() {
    var $this = $(this);

    checkedInputs($this, $expiringDateFields);
  });
});