
function AddCart(id) {
    $.ajax({
        url:'AddCart/'+id, 
        type:'GET',

    }).done(function(response){
        RenderCart(response);
        alertify.success('Success message');
    });
}

$(".cart_info").on("click",".cart_delete .cart_quantity_delete",function() {
    $.ajax({
        url:'Delete-Cart/'+$(this).data("id"),
        type:'GET',
        
    }).done(function() {
        
        setTimeout(function(){// wait for 5 secs(2)
            location.reload(); // then reload the page.(3)
         });
    });
});


$(".edit-all").on("click",function() {
    var list = [];
    var _token = $("meta[name='csrf-token']").attr("content");
    $("table tbody tr td").each(function() {
        $(this).find("input").each(function() {
            var element = {key:$(this).data("id"),value:$(this).val()};
            list.push(element);
        });
    });
    $.ajax({
        url:'Save-All/', 
        type:'POST',
        data:{
            "_token":_token,
            "data":list
        }

    }).done(function(_response){
        location.reload();
    });
    console.log(list);
});


function SaveListItemCart(id) {

   console.log($(".quantity_"+id).val());

    $.ajax({
        url:'Save-Item-List-Cart/'+id+'/'+$(".quantity_item_"+id).val(), 
        type:'GET',

    }).done(function(){
        setTimeout(function(){// wait for 5 secs(2)
            location.reload(); // then reload the page.(3)
         });
    });
}

function RenderCart(response) {
    $("#total-quantity-show").empty();
    $("#total-quantity-show").html(response);
    $("#total-quantity-show").text($("#total-quantity-cart").val())

}


$(document).ready(function(){
    $('.cart_quantity_up').click(function(e){
     e.preventDefault();
     fieldName = $(this).attr('field');

     //Fetch qty in the current elements context and since you have used class selector use it.
     var qty = $(this).closest('tr').find('.cart_quantity_input');
     //var qty = $(this).closest('tr').find('input[name='+fieldName+']');

     var currentVal = parseInt(qty.val());
     if (!isNaN(currentVal)) {
         qty.val(currentVal + 1);
     } else {
         qty.val(0);
     }

     //Trigger change event
     qty.trigger('change');
 });

 $(".cart_quantity_down").click(function(e) {
     e.preventDefault();
     fieldName = $(this).attr('field');

     //Fetch qty in the current elements context and since you have used class selector use it.
     var qty = $(this).closest('tr').find('.cart_quantity_input');
     //var qty = $(this).closest('tr').find('input[name='+fieldName+']');

     var currentVal = parseInt(qty.val());
     if (!isNaN(currentVal) && currentVal > 1) {
         qty.val(currentVal - 1);
     } else {
         qty.val(1);
     }

     //Trigger change event
     qty.trigger('change');
 });    
 
});

// contact
$(document).ready(function() {
    $(".btn-submit-contact").click(function(e){
        e.preventDefault();
        var _token = $("meta[name='csrf-token']").attr("content");
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var subject = $("input[name='subject']").val();
        var  content = $("textarea[name='content']").val();
        $.ajax({
            url: "/addContact",
            type:'POST',
            data: {_token:_token,
                  name:name,
                  subject:subject,
                  email:email,
                  content:content},
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    $("#main-contact-form").trigger("reset");
                    alert(data.success);
                }else{
                    $("#main-contact-form").trigger("reset");
                    printErrorMsg(data.error);
                }
            }
        });


    }); 
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( _key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

});


//============================checkout===========================================
$('document').ready(function() {
    let checkcart = $('#checkcart').val();
    let customerid = $("#customer_id").val();
 $('#btn-checkout').click(function () {
    $('#form-checkout').validate({
            rules: {
                lastname: {
                    required:true
                },
                middlename: {
                    required:true
                },
                firstname: {
                    required:true
                
                },
                phone: {
                    required:true
                },
                email: {
                    required:true,
                    email:true
                },
                address: {
                    required:true
                },
                method:{
                    required:true
                }

            },

            submitHandler: function(_form) {
                if(!customerid){
                    swal("Bạn vui lòng đăng nhập hoặc đăng ký để mua hàng","", "error"); 
                    return false;
                }   
                if(!checkcart) {
                    swal("Bạn chưa mua hàng","", "error"); 
                }else{

                let customer_id = $("#customer_id").val();
                let lastname = $('#lastname').val();
                let middlename = $('#middlename').val();
                let firstname = $('#firstname').val();
                let phone = $('#phone').val();
                let email = $('#email').val();
                let address = $('#address').val();
                let note = $('#note').val();
                let method =  $('#method').val();
                let total = $("#total").val();
                var _token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                    url: 'storecheckout',
                    type: 'POST',   
                    data: {lastname:lastname,middlename:middlename,
                    firstname:firstname,phone:phone,email:email,address:address,
                    note:note,method:method,customer_id:customer_id,total:total,_token:_token},
                        success:function() {
                                swal( "Check Success","", "success");
                            setTimeout(function(){
                                location.reload();
                            },1000);
                            
                        }
                    });
             
                // bắt buộc để chặn gửi bình thường vì bạn đã sử dụng ajax
                return false;
                }
            }
        });
     });
});

//============================Form-Review===========================================

$(document).ready(function() {
      
    $(".btn-review").click(function(e){
         e.preventDefault();
      
        var name = $("#name").val();
        var email = $("#email").val();
        var content = $("#content").val();
        var product_id = $("#product_id").val();
        var _token = $("meta[name='csrf-token']").attr("content");
            if(name=="" || email=="" || content==""){
                alert('các trường không được để trống')
            } else {
                $.ajax({
                    url:'/storeReview',
                    method:'post',
                    data:{name:name,email:email,content:content,product_id:product_id,_token:_token},
                    success:function(_response) {
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        DisplayReviews();
                        $("#formReview")[0].reset();
                    }
                 
                });
            }
     
        return false;
        
    });


    DisplayReviews();
    function DisplayReviews() {
        var product_id = $('#product_id').val();
        var _token = $("meta[name='csrf-token']").attr("content");
        $("#load-Reviews").html("");
        $.ajax({
            url:"/display_review",
            type:"post",
            data:{product_id:product_id,_token:_token},
            success:function(data) {
                $.each(data,function(_key,value){
                    $("#load-Reviews").append("<ul>"
                        +"<li><a href=''><i class='fa fa-user'>"+value.name+"</i></a></li>"+
                        "<li><a href=''><i class='fa fa-calendar-o'></i>"+value.created_at+"</a></li>"+
                        "<p>"+value.content+"</p>"+
                        "</ul>");
                });
            }
        });
    }

});
//=====================search product ==================================================== 
$(document).ready(function(){
    $("#search").autocomplete({
        source: "{{ url('/search') }}",
            focus: function( _event, _ui ) {
            //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
            return false;
        },
        select: function( _event, ui ) {
            window.location.href = ui.item.url;
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="image"><img src="' + item.feature_image_path + '" ></div><div class="label"><h4><b>' + item.name + '</b></h4></div></div></a>';
        return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append(inner_html)
                .appendTo( ul );
    };
});

//=====================Comment Post ==================================================== 

$(document).ready(function() {
    $('#btn-post-comment').click(function(){
            $('#form-comment').validate({
            rules: {
                name: {
                    required:true
                },
                email: {
                    required:true,
                    email:true
                },
                comment: {
                    required:true
                
                }
            },

            submitHandler:function(form) {
                var name = $("#name").val();
                var email = $("#email").val();
                var comment = $("#comment").val();
                var parent_id = $("#parent_id").val();
                var post_id = $("#post_id").val();
                var _token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url:'/add_comment',
                    method:'POST',
                    data:{name:name,email:email,comment:comment,parent_id:parent_id,post_id:post_id,_token:_token},
                    dataType:"JSON",
                    success:function(respone) {
                        loadComemnt();
                        loadRespones();
                        $("#form-comment")[0].reset();
                    }

                });
                return false;
            }
     });
});

    loadComemnt();
    function loadComemnt() {
        var _token = $("meta[name='csrf-token']").attr("content");
        var post_id = $("#post_id").val();
        $.ajax({
            url:'/load-comment',
            method:'POST',
            data:{_token:_token,post_id:post_id},
            success:function(respone) {
                $("#display_comment").html(respone);
                
            }
        });
    }
    loadRespones();
    function loadRespones() {
        var _token = $("meta[name='csrf-token']").attr("content");
        var post_id = $("#post_id").val();
        $.ajax({
            url:'/load-respones',
            method:'POST',
            data:{_token:_token,post_id:post_id},
            success:function(respone) {
                $("#respones").html(respone);
                
            }
        });
    }
    $(document).on('click', '.reply', function() {
        var comment_id = $(this).attr("id");
        $('#parent_id').val(comment_id);
        $('#name').focus();
    });
});
//=====================Add WishList ==================================================== 

$(document).ready(function(){
    $(".btn-add-wishlist").on('click', function() {
       var link_data = $(this).data('id');
       var _token = $("meta[name='csrf-token']").attr("content");
       $.ajax({
          type: "POST",
          url: '/add-with-list',
          data: ({product_id: link_data,_token:_token}),
          success: function(data) {
               if(data == '1')
               {
                  $('a[data-id="' + link_data + '"] > .whishstate').html('<i class="fa fa-minus-square">Remove wishlist</i>');
               }
               else{
                   $('a[data-id="' + link_data + '"] > .whishstate').html('<i class="fa fa-plus-square">Add to wishlist</i>');
               }
               
          }   
       });   
    }); 

    $(".delete-wishlist").on('click',function () {
        var id = $(this).data('id');

        $.ajax({
            url:'/delete-wishlist',
            method:'POST',
            data:{id:id},
            success:function(respone) {
                
            }
        });
    });

});

//=====================Delete Wishlist ==================================================== 

$(".delete-wishlist").click(function() {
    let id = $(this).data('id');
    let row = $(this);
    var _token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url:"/delete-wishlist",
        type:'POST',
        data:{id:id,_token:_token},
        success:function() {
            row.parent().parent().remove();
        }
      });
});
