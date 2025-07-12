$(function () {
  $(".tags_select").select2({
    tags: true,
    tokenSeparators: [',']
  });
});

function actionDelete(event) {
  event.preventDefault();
  let urlRequest = $(this).data('url');
  let row = $(this);
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: 'GET',
        url: urlRequest,
        success: function (data) {
          if (data.code == 200) {
            row.parent().parent().remove();
          }
        },
        error: function (e) {
          console.error(e)
        }
      });

    }
  })
}

$(function () {
  $(document).on('click', '.action_delete', actionDelete);
});

$(function () {
  $('.checkbox_wapper').on('click', function () {
    $(this).parents('.col-md-3').find('.checkbox_chilrent').prop('checked', $(this).prop('checked'));
  });

  $('.checkall').on('click', function () {
    $(this).parents().find('.checkbox_chilrent').prop('checked', $(this).prop('checked'));
    $(this).parents().find('.checkbox_wapper').prop('checked', $(this).prop('checked'));

  });
});
//update status brand 

$(document).ready(function () {

  $('.status_on').on('change', function () {
    var id = $(this).data("id");

    $.ajax({
      url: 'update-status-active/' + id,
      type: 'GET',
    });
  });

  $('.status_off').on('change', function () {
    var id = $(this).data("id");

    $.ajax({
      url: 'update-status-untive/' + id,
      type: 'GET',
    });
  });

});