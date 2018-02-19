jQuery(document).ready(function () {
    if(jQuery("div#supporter-list").length === 1){
    jQuery.getJSON('https://shop.firegento.com/mageuc/supporter/list/sku/mageunconf-2018/format/json/?callback=?', '', function (data) {
        items = [];
        jQuery.each(data['supporter_list'], function (key, val) {
            items.push("<li>" + val + "</li>");
        });

        jQuery("<ul/>", {
            html: items.join("")
        }).appendTo("div#supporter-list");
    });
    }
});
