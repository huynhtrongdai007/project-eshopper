$(function(){
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
        type:'GET',
        url:urlRequest,
        success:function(data) {
          if(data.code == 200) {
            row.parent().parent().remove();
          }
        },
        error:function() {
            
        }
      });
      
    }
  })
  }

  $(function() {
    $(document).on('click','.action_delete',actionDelete);
});
