/*
 *   select state and city from country
 */

//select state from country
function select_state_from_country(co_id, url, st_eid, cus_sid) {
    var passData = 'id=' + co_id;
    init_select_list(st_eid);
    if (co_id > 0) {
        $.ajax({
            type: 'get',
            data: passData,
            url: url,
            success: function (data) {
                if (data.states) {
                    var states = data.states;
                    for (var i = 0; i < states.length; i++) {
                        var state = states[i];
                        if (cus_sid != undefined && cus_sid != "") {
                            if (state.st_id == cus_sid) {
                                var state_data = '<option value="' + state.st_id + '" selected>' + state.st_name + '</option>';
                            } else {
                                var state_data = '<option value="' + state.st_id + '">' + state.st_name + '</option>';
                            }

                        } else {
                            if (state.st_default) {
                                var state_data = '<option value="' + state.st_id + '" selected>' + state.st_name + '</option>';
                            } else {
                                var state_data = '<option value="' + state.st_id + '">' + state.st_name + '</option>';
                            }
                        }


                        jQuery('#' + st_eid).append(state_data);
                    }
                    jQuery('#' + st_eid).trigger('change');
                }
            }
        });
    }
}

//select city from state
function select_city_from_state(st_id, url, ci_eid, mem_city_id) {
    var cur_city_val = $('#' + ci_eid).val();
    var passData = 'state_id=' + st_id;
    init_ahead_input(ci_eid);

    if (st_id > 0) {
        $.ajax({
            type: 'get',
            data: passData,
            url: url,
            success: function (data) {

                if (data.cities) {
                    var cities = data.cities;
                    var city_names = [];

                    if (mem_city_id != undefined) {
                        var mem_city_name = "";

                        for (var i = 0; i < cities.length; i++) {
                            var city = cities[i];
                            city_names.push(city.ci_name);

                            if (city.ci_id == mem_city_id) {
                                mem_city_name = city.ci_name;
                            }
                        }

                        set_ahead_data(city_names, ci_eid);
                        jQuery('#' + ci_eid).typeahead('val', mem_city_name);
                    } else {

                        for (var i = 0; i < cities.length; i++) {
                            var city = cities[i];
                            city_names.push(city.ci_name);
                        }
                        set_ahead_data(city_names, ci_eid);
                    }
                }
            }
        });
    }
}

//init select list: state_listbox
function init_select_list(sel_id) {
    jQuery('#' + sel_id).empty().append('<option value="">--- Select ---</option>');
}

//init ahead list: city_input_box
function init_ahead_input(ci_eid) {
    jQuery('#' + ci_eid).typeahead('destroy').val('');
}

//set ahead data: city_input_box
function set_ahead_data(datas, ci_eid) {
    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // `states` is an array of state names defined in "The Basics"
        local: datas
    });

    jQuery('#' + ci_eid).typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: cities
        });
}

$("form").keypress(function (e) {
    if (e.which == 13) {
        var $targ = $(e.target);

        if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
            var focusNext = false;
            jQuery(this).find(":input:visible:not([disabled],[readonly]), a").each(function () {
                if (this === e.target) {
                    focusNext = true;
                }
                else if (focusNext) {
                    $(this).focus();
                    return false;
                }
            });

            return false;
        }
    }
});

function reset_category_list(themeid, url, cat_obj_id) {
    init_select_list(cat_obj_id);
    $.ajax({
        type: 'get',
        data: 'theme_id=' + themeid,
        url: url,
        success: function (data) {
            if (data.categories) {
                var sub_cats = data.categories;
                for (var i = 0; i < sub_cats.length; i++) {
                    var sc = sub_cats[i];
                    var cat_data = '<option value="' + sc.mc_id + '" selected>' + sc.mc_name + '</option>';
                    jQuery('#' + cat_obj_id).append(cat_data);
                }
            }
        }
    });
}

function select_subcategory_from_category(level, ca_id, url, sub_ca_eid, cus_cid) {
    var passData = 'id=' + ca_id;
    init_select_list(sub_ca_eid);
    if (ca_id > 0) {
        $.ajax({
            type: 'get',
            data: passData,
            url: url,
            success: function (data) {
                if (data.subcategories) {
                    //alert(responseText);
                    var sbs = data.subcategories;
                    for (var i = 0; i < sbs.length; i++) {
                        var sb = sbs[i];

                        if (level == 1) {
                            var sid = sb.smc_id;
                            var sname = sb.smc_name;
                        } else if (level == 2) {
                            var sid = sb.sb_id;
                            var sname = sb.sb_name;
                        } else if (level == 3) {
                            var sid = sb.ssb_id;
                            var sname = sb.ssb_name;
                        }

                        if (cus_cid != undefined) {
                            if (sid == cus_cid) {
                                var cat_data = '<option value="' + sid + '" selected>' + sname + '</option>';
                            } else {
                                var cat_data = '<option value="' + sid + '">' + sname + '</option>';
                            }
                        } else {
                            var cat_data = '<option value="' + sid + '">' + sname + '</option>';
                        }
                        jQuery('#' + sub_ca_eid).append(cat_data);
                    }
                }

                jQuery('#' + sub_ca_eid).trigger('change');
            }
        });
    }
}

function select_shop_from_merchant(mer_value, url, shop_id, shop_value) {
    var passData = 'id=' + mer_value;
    init_select_list(shop_id);
    if (mer_value > 0) {
        $.ajax({
            type: 'get',
            data: passData,
            url: url,
            success: function (data) {
                if (data.shops) {
                    //alert(responseText);
                    var shops = data.shops;
                    for (var i = 0; i < shops.length; i++) {
                        var shop = shops[i];
                        var sid = shop.stor_id;
                        var sname = shop.stor_name;

                        if (shop_value != undefined) {
                            if (sid == shop_value) {
                                var cat_data = '<option value="' + sid + '" selected>' + sname + '</option>';
                            } else {
                                var cat_data = '<option value="' + sid + '">' + sname + '</option>';
                            }
                        } else {
                            var cat_data = '<option value="' + sid + '">' + sname + '</option>';
                        }
                        jQuery('#' + shop_id).append(cat_data);
                    }
                }

                jQuery('#' + shop_id).trigger('change');
            }
        });
    }
}

function show_sub_theme_select(url, parent_theme_id, select_div_id, select_id) {
    var passData = 'parent_theme_id=' + parent_theme_id;
    $.ajax({
        type: 'get',
        data: passData,
        url: url,
        success: function (data) {
            var child_themes = data.child_theme;
            var count = child_themes.length;
            if (count > 0) {
                for (var i = 0; i < count; i++) {
                    var sub_theme = child_themes[i];
                    var option = '<option value="' + sub_theme.theme_id + '" >' + sub_theme.theme_name + '</option>';

                    $('#' + select_id).append(option);
                }
                $('#' + select_div_id).show();
            } else {
                $('#' + select_div_id).hide();
            }
        }
    });
}