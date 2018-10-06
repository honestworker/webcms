$(document).ready(function () {

    // Cancel
    $('#page-operations .btn-green').click(function (e) {
        e.preventDefault();
        location.reload();
    });

    // Edit icons
    $('#wbm_icon1').click(function () {
        var icon = $(this).find('i').attr('class');
        var arr = icon.split(" ");

        $('#inputContent1 input').val(arr[1]);

        $('#inputContent1 .btn-red').click(function (e) {
            var newIcon = $('#inputContent1 input').val();
            $('#wbm_icon1 i').attr('class', 'fa ' + newIcon);
            $('#wbm-icon-img1').val(newIcon);
        });
    });

    $('#wbm_icon2').click(function () {
        var icon = $(this).find('i').attr('class');
        var arr = icon.split(" ");

        $('#inputContent2 input').val(arr[1]);

        $('#inputContent2 .btn-red').click(function (e) {
            var newIcon = $('#inputContent2 input').val();
            $('#wbm_icon2 i').attr('class', 'fa ' + newIcon);
            $('#wbm-icon-img2').val(newIcon);
        });
    });

    // Change admin photo
    $('#add_admin_photo').click(function () {
        $('.new-admin-photo').submit();
    });

    // Change admin password
    $('#save-admin-password').click(function () {
        $('#change-admin-password').submit();
    });

    //Change background image
    $('#save-new-bg').click(function () {
        $('#upload_bgimage').submit();
    });

    // Add new objective
    $('#add_ot').click(function () {
        $('#add_obj_title').submit();
    });


    // Edit objective
    $('.edtxtslider').on('click', function () {
        var form = $(this).closest('.edit_text_objective');
        var num = form.attr('data');
        form.find('input[name=text]').val($('#new-txt-slobj' + num).html());
        form.submit();
    });

    // Del objective
    $('.del-one-txtobj').on('click', function () {
        $(this).closest('form').submit();
    });


    // Group checkbox
    $('#table-title-slider th input[type=checkbox]').click(function () {

        if ($(this).prop("checked")) {
            $("#table-title-slider td input[type=checkbox]").prop({"checked": true});
        }
        else {
            $("#table-title-slider td input[type=checkbox]").prop({"checked": false});
        }
    });

    // Del select objective
    $('#dellselobj').click(function (e) {
        e.preventDefault();
        var str = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            str += $(e).attr('data') + ",";
        });
        $('.delete_text_objective > input[name=index]').val(str);
        $('.delete_text_objective').submit();
    });

    // Del all objective
    $('#dellallobj').click(function (e) {
        e.preventDefault();
        $('.delete_text_objective > input[name=index]').val('all');
        $('.delete_text_objective').submit();
    });

    // Remember tab
    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                return true
            }
        }
        return false;
    }

    function remember(item) {
        var cookieName = 'tabSelected';
        var cookieOptions = {expires: 7, path: '/'};
        $.cookie(cookieName, item, cookieOptions);
    }


    /********************************* Services **************************************/
    function addslashes(str) {
        str.replace(/([\"])/g, "&quot;");
        return str.replace(/([\'])/g, "&apos;");
    }

    function myTrim(x) {
        return x.replace(/^\s+|\s+$/gm, '');
    }

    // Change text
    $('.wbx_submit').click(function (e) {
        e.preventDefault();
        $('.wbx_info').each(function (i, e) {
            // var value = addslashes($(e).html());
            var value = $(e).html();
            if (typeof value === 'string' || value instanceof String) {
                value = myTrim(value);
            }
            else {
                console.log(value);
                value = '';
            }
            var name = $(e).attr('name');
            // $('#wbx_change_info').append("<input type='hidden' name='" + name + "' value='" + value + "' />");
            $('#wbx_change_info').append('<textarea style="display: none" name="' + name + '">' + btoa(value) + '</textarea>');

        });
        $('.wbx_info_header').each(function (i, e) {
            // var value = addslashes($(e).html());
            var value = $(e).html();
            if (typeof value === 'string' || value instanceof String) {
                value = myTrim(value);
            }
            var name = $(e).attr('name');
            // $('#wbx_change_info').append("<input type='hidden' name='" + name + "' value='" + value + "' />");
            console.log(value);
            $('#wbx_change_info').append('<textarea style="display: none" name="' + name + '">' + btoa(value) + '</textarea>');

        });
        var type = $(this).attr('data');
        $('#wbx_change_info').append("<input type='hidden' name='type' value='" + type + "' />");

        $('#wbx_change_info').submit();
    });

    // Edit icono
    $('#wbx_edit_icons .circle').click(function (e) {
        var Index = $(this).index('#wbx_edit_icons .circle');
        var icon = $(this).find('i').attr('class');
        var arr = icon.split(" ");

        $('#inputContent').val(arr[1]);
        console.log(Index);
        $('#wbx_save_icon').click(function (e) {
            //console.log(Index);
            var newIcon = $('#inputContent').val();
            console.log(newIcon);
            $('#wbx_edit_icons .circle').eq(Index).find('i').attr('class', 'fa ' + newIcon);
            $('#wbx_save_icon').unbind('click');
        });
    });

    /********************************* Contact **************************************/

    // Del select objective
    $('#dellselobjcont').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var date = father.find('td:eq(3)').text();
            var name = father.find('td:eq(4)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong> " + date + " - " + name + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    //Add new store
    // Add table info
    $('#wbx_save_table').click(function () {
        $(this).closest('form').find('.wbx_info2').each(function (i, e) {
            var value = $(e).html();
            var name = $(e).attr('name');
            $('#wbx_add_store').append('<textarea style="display: none" name="' + name + '">' + btoa(value) + '</textarea>');
        });
        var type = $(this).attr('data');
        $('#wbx_add_store').append("<input type='hidden' name=type value='" + type + "' />");

        $('#wbx_add_store').submit();
    });

    // Add table info3
    $('#wbx_save_table3').click(function () {

        var form = $(this).closest('form');
        form.find('.wbx_info3').each(function (i, e) {
            var value = $(e).html();
            var name = $(e).attr('name');
            form.append('<textarea style="display: none" name="' + name + '" >' + btoa(value) + '</textarea>');
        });
        var type = $(this).attr('data');
        form.append("<input type='hidden' name=type value='" + type + "' />");
        form.submit();
        // $('#wbx_add_store3').submit();
    });

    // Add new state

    $('.wbx_add_new_state_button').click(function () {
        $(this).closest('form').find('.wbx_new_state').css('display', 'block');
    });

    $('.bmw_edit_submit').on('click', function () {
        var form = $(this).closest('.bmw_edit_table');
        form.find('.wbx_info2').each(function (i, e) {
            var value = $(e).html();
            if (typeof value === 'string' || value instanceof String) {
                value = unescape(encodeURIComponent(value));
                value = myTrim(value);
            }
            else {
                value = '';
            }
            var name = $(e).attr('name');
            form.append('<textarea style="display: none" name="' + name + '" >' + btoa(value) + '</textarea>');

            // form.append("<input type='hidden' name=" + name + " value='" + btoa(value) + "' />");
        });
        var type = $(this).attr('data');
        form.append("<input type='hidden' name=type value='" + type + "' />");
        form.submit();
    });

    // Del select objective
    $('#dellselobjstore').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var name = father.find('td:eq(3)').text();
            var address = father.find('td:eq(4)').text();
            var state = father.find('td:eq(5)').text();
            selectedInfo += "<p><strong>#" + num + ": " + name + "</strong><br><strong>Address: </strong> " + address + "<br/><strong>State/City: </strong>" + state + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    $('#dellselobjvacancy').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var title = father.find('td:eq(4)').text();
            var location = father.find('td:eq(5)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong>" + title + " / " + location + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    $('#dellselobjapp').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var name = father.find('td:eq(4)').text();
            var position = father.find('td:eq(5)').text();
            var location = father.find('td:eq(6)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong> Position Applied: " + position + " / " + location + "<br/>Applicant Name: " + name + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    // footer-setup
    $('#dellselobjfoot').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var name = father.find('td:eq(2)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong> " + name + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    // Newsletter
    $('#dellselobjnews').click(function () {
        var str = '';
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var name = father.find('td:eq(3)').text();
            var email = father.find('td:eq(4)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong> " + name + " - " + email + "</p>";
            str += $(e).attr('data') + ",";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });

    // About
    $('#dellselobjabout').click(function () {
        var selectedInfo = '';
        $("#table-title-slider td:first-child input:checked").each(function (i, e) {
            var father = $(e).closest('tr');
            var num = father.find('td:eq(1)').text();
            var name = father.find('td:eq(3)').text();
            selectedInfo += "<p><strong>#" + num + ":</strong> " + name + "</p>";
        });
        $('#wbx_who_delete').html(selectedInfo);
    });


    // Menu
    var url = document.location.href;
    $.each($("#sidebar a"), function () {
        if (this.href == url) {
            $(this).closest('li').addClass('active');
        }
        ;
        if ($(this).attr('href') == 'applicants' && this.href == url) {
            $('#wbx-careers').addClass('active');
        }
        ;
    });

    // Footer
    //$('.ft_save').click(function(){
    $("body").delegate(".ft_save", "click", function () {
        if ($('#statusSwitch').children('div').hasClass('switch-on')) {

            $('#animatedActiveStatus').val('1');
        } else {

            $('#animatedActiveStatus').val('0');
        }
        $(this).closest('form').submit();
    });

    // Reload page
    $('#wbx-cancel').click(function (e) {
        e.preventDefault();
        window.location.reload();
        console.log('click');
    });

});//jQuery