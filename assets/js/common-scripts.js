var Script = function () {
//    sidebar toggle
var cell = false;
    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
                cell = true;
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
                cell = false;
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });
}();

$(document).ready(function(){
    $(".sidebar-toggle-box").click(function(){
        console.log("escondendo");
        $("#sidebar > ul").toggle();
        $('#main-content').toggleClass('sidebar-close');        
        if($(window).width() > 768){
            $("#sidebar").toggle();
            $("#sidebar > ul").show();
        }
        else{
            $("#sidebar").show();
            $('#main-content').removeClass('sidebar-close');
        }
    });
});