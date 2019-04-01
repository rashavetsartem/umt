<script>
  /*поиск*/
$(document).ready(function(){
        $("#search").keyup(function(){
            _this = this;
            $.each($("table tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();                
                });
            });
        });
</script>

<script>
$(document).ready(function(){
  /* изменение цвета тр по одинарному клику посредством добавления класса */
  $("tr").click(function(){
  $("tr").removeClass("grey");
  $(this).addClass("grey");
  });
  /* имитация нажатия кнопки детали по двойному клику на тр, с проверкой по data-name */
  $("tr").dblclick(function(){
    var id = $(this).data('id');
    var trType = $(this).data('name');
    if(trType=='repairs'){
      $('*[data-name="repairs-det"][data-id="'+id+'"]').click();
    }else if (trType=='orders'){
      $('*[data-name="orders-det"][data-id="'+id+'"]').click();  
    }else if (trType=='reclamations'){
      $('*[data-name="reclamation-comment"][data-id="'+id+'"]').click();  
    };
  });
});
</script>