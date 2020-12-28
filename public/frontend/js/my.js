
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

    }).done(function(response){
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