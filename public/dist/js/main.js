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
  });
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

// FeeShip
$(document).ready(function () {
  $(".choose").on('change', function () {
    let action = $(this).attr('id');
    let code = $(this).val();
    let _token = $("meta[name='csrf-token']").attr("content");
    let result = '';

    if (action == 'province') {
      result = 'district';
    } else {
      result = 'ward';
    }
    $.ajax({
      url: 'select-delivery',
      type: "GET",
      data: ({ action: action, code: code, _token: _token }),
    }).done(function (data) {
      $('#' + result).html(data);
    });
  });

  // add feeship
  $(document).on('click', '#btn-add-feeship', function (e) {
    e.preventDefault();
    let province_code = $('#province').val();
    let district_code = $('#district').val();
    let ward_code = $('#ward').val();
    let fee_ship = $('#fee_ship').val();
    $.ajax({
      url: 'store',
      type: "POST",
      data: ({ province_code: province_code, district_code: district_code, ward_code: ward_code, fee_ship: fee_ship, _token: $('meta[name="csrf-token"]').attr('content') }),
    }).done(function (data) {
      if (data.code == 200) {
        alert(data.message);
      } else {
        alert(data.message);
      }
    });
  });
});