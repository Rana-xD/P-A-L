$(function(){
  $('#error').hide();

  $('#submit').click(function() {
    $.ajax({
      url: 'login',
      type: 'get',
      data: {username: $('input[name=name]').val()
    }
    })
    .done(function(data) {

    })

  });
});
