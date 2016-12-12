$(document).ready(function() {

    $("#tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');

    $(function() {
        var tooltips = $("[title]").tooltip({
            position: {
                my: "right top",
                at: "right-5 top+55",
                collision: "none"
            }
        });
    });
    console.log(loggedin);
    if(loggedin === true){
    $(".top:eq( 1 )").removeAttr("href").css("cursor","pointer");
    $(".myaccount").on("mouseenter", function() {
    $(".accountOpt").show();

}).on("mouseleave", function() {
    $(".accountOpt").hide();
});
}
  $('.logout').click(function(){
      var loggedin = false;
    });


    $('#password, #confirm_password').click(function() {
      $('#message').html('');
    });

    $('.signinBtn').click(function(){
      $("#account").off("click");
      $("#account").attr("href", "profile.php");
    });

});

function validate(){

    var a = document.getElementById("password").value;
    var b = document.getElementById("confirm_password").value;
    if (a!=b) {
      var node = document.createTextNode("Password doesn't match");
      var element = document.getElementById("message");
      element.appendChild(node);
    return false;
    }
}
