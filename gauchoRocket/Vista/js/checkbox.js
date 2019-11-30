$('input:checkbox').click(
    function() {
      var limitReached = $('input:checkbox:checked').length >= 3;   
      $('input:checkbox').not(':checked').attr('disabled', limitReached);
    }
  );
