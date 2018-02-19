jQuery(document).ready(function () {
    console.log('lololol');
    jQuery.getJSON('http://shop.firegento.dev/mageuc/supporter/list/sku/mageunconf-2018/format/json/?callback=?', '', function (data) {
        items = [];
        jQuery.each(data['supporter_list'], function (key, val) {
            items.push("<li>" + val + "</li>");
        });

        jQuery("<ul/>", {
            html: items.join("")
        }).appendTo("div#supporter-list");
    });
});
