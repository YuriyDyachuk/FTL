$(function(){
   $(document).on('click', '.set_order_status', function (e) {
       e.preventDefault();
       let status = this.dataset.status;
       $(this).siblings('.status_field').val(status);
     //  console.log(status, $(this).closest('.status_field'));
   });
});
