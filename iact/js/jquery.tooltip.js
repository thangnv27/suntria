/*Create QUANGNT 4/10/2012*/
var tooltip = {}, isLoad = 0;
function showToolTip(id) {
    
var strHTML=GetDataTooltip(id);
    Tip(strHTML, WIDTH, 300, ABOVE, true);
}

function GetDataTooltip(id) {
    var el = $("div[onmouseover=\"showToolTip('" + id + "')\"]");
    /*truntp modified 10/12/2012*/
    if (tooltip[id] == undefined || tooltip[id] == null) {
        el.unbind('onmouseover');
        if (isLoad != id) {
            isLoad = id;
            $.ajax({
                url: ajaxurl,
                data:{
                    action: 'product_tooltip',
                    product_id: id
                },
                dataType: 'json',
                cache: true,
                async: false,
                type: 'GET',
                success: function (data) {
                    tooltip[id] = data;
                    el.mousemove(function (e) {
                        el.bind('onmouseover', showToolTip(id));
                        el.unbind('mousemove');
                    });
                    isLoad = 0;
                }
            });
        }
    }
    return getStringTooltip(id);
}

function getStringTooltip(id) {
    if (tooltip[id] == undefined || tooltip[id] == null)
        return "";
    var data = tooltip[id];
    var strhtml = "<div id=\"mystickytooltip\" class=\"mytooltip\">";
    strhtml += "<div id=\"sticky" + data.id + "\" class=\"atip\">";
    strhtml += "<div class=\"tipname\">" + data.title + "</div>";
    strhtml += "<hr class=\"line\"/>";
    strhtml += "<div class=\"content\">" + data.content + "</div>";
    strhtml += "</div>";
    strhtml += "</div>";

    return strhtml;
}