jQuery.fn.easytooltip = function(id)
{
    if(!document.getElementById('tool_tip'))
    {
       $("body").append('<div id="tool_tip_action">&nbsp;</div>');
       $("#tool_tip_action").css({"background-color": "#ffffff", border: "1px solid #000", position: "absolute", "z-index": "1001", "display": "none"});
    }
    $("#" + id).hide();

        $(this).bind("mousemove", function(e)
        {
            $("#tool_tip_action").html($("#" + id).html()).css({"left": e.pageX + 20, "top" : e.pageY + 20}).show();
        }).bind("mouseout", function()
        {
            $("#tool_tip_action").hide().css({"left": 0, "top" : 0});
        });
}