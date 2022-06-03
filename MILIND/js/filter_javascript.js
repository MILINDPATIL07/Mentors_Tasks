$(document).ready(function() {
    $("#fetchval").on('change', function() {
        var value = $(this).val();
        // alert(value);        
        $.ajax({
            url: "fetch.php",
            type: "POST",
            data: 'request=' + value,
            beforeSend: function() {

                $(".container").html("<span>processing...</span>");
            },
            success: function(data) {
                $(".container").html(data);
            }
        })
    });
});