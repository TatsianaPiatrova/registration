        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            //скрыть или показать кнопку Назад
            $(function(){
                var back = $("#back");

                if (window.location.pathname === "/index.php"){
                    back.css( "display","none" );
                }else{
                    back.css( "display","block" );
                }
            })      

            // JavaScript для удаления студента
            $(document).on("click", ".delete-object", function() {
                const id = $(this).attr("delete-id");
            
                bootbox.confirm({
                    message: "<h4>Вы уверены?</h4>",
                    buttons: {
                        confirm: {
                            label: "<span class=\"glyphicon glyphicon-ok\"></span> Да",
                            className: "btn-danger"
                        },
                        cancel: {
                            label: "<span class=\"glyphicon glyphicon-remove\"></span> Нет",
                            className: "btn-primary"
                        }
                    },
                    callback: function (result) {
                        if (result == true) {
                            $.post("../controllers/delete_student.php", {
                                object_id: id
                            }, function(data){
                                location.reload();
                            }).fail(function() {
                                alert("Невозможно удалить.");
                            });
                        }
                    }
                });            
                return false;
            });

        </script>
    </body>
</html>