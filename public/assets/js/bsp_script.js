var BSP = function() {
    //Console flag
    /*Start Code To Create Site Url*/
    var web_url = document.location.origin;
    var site_url = "";
    switch(web_url)
    {
        case "http://localhost:7777":
            site_url = "http://localhost:7777/server/thai-spa/";
            break;
        case "http://thaispa.nayatax.com":
            site_url = "http://thaispa.nayatax.com/";
            break;
        case "https://tcts.tcthaispa.uk":
            site_url = "https://tcts.tcthaispa.uk/";
            break;
        case "http://192.168.1.201:1234":
            site_url = "http://192.168.1.201:1234/php_server/thai-spa/";
            break;
    }
    /*End Code To Create Site Url*/
    var console_log_flag = true;
    return {
        get_site_url: function (){
            return site_url;
        },
        redirect_to: function (url){
            window.location=url;
        },
        custom_trim_form_input:function(formID) // Call function trim form text input (formID = Form OR DivID)
        {
            $("#"+formID).find('input:text,textarea').each(function(){
                $(this).val(
                    $.trim($(this).val())
                );
            });
        },
        /*Used For Get Employee Holiday Popup
         *  Parameters :
         *               1)  FormMode : Add/Edit
         *               2)  EditRecordId : When FormMode is Add Then '' Else Edit Id
         *               3)  EmployeeSelectionType : Single/Multi
         *               4)  EmployeeId : When EmployeeType is Single Then EmployeeId Else ''
         *
         * */
        get_employee_holiday_popup:function(FormMode,EditRecordId,EmployeeSelectionType,EmployeeId,url)
        {
            var data = {
                'mode': FormMode,
                'edit_record_id': EditRecordId,
                'employee_selection_type': EmployeeSelectionType,
                'employee_id': EmployeeId
            };
            $.ajax({
                url:site_url+'api/api_get_employee_holiday_popup',
                method: 'POST',
                dataType: "html",
                data: data,
                success: function (result)
                {
                    //Remove Old Html From Body
                    $("body").find("#employee_holiday_modal_popup").remove();
                    //Append New Html On Body
                    $("body").append(result);
                    //Display Popup
                    $('#employee_holiday_modal_popup').modal("show");
                }
            });
        },
        redirect_back:function(){
            history.go(-1);
        },
        reload_page:function(){
            location.reload();
        },
        only:function(val,el){
            if(val=="digit"){
                if(document.getElementById(el).value.match(/[^0-9]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^0-9]/g, '');
                }
            }if(val=="int_flot"){
                if(document.getElementById(el).value.match(/[^0-9.]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^0-9]/g, '');
                }
            }else if(val=="alpha"){
                if(document.getElementById(el).value.match(/[^a-zA-Z]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z]/g, '');
                }
            }else if(val=="only_string"){
                if(document.getElementById(el).value.match(/[^a-zA-Z .]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z]/g, '');
                }
            }else if(val=="alpha_digit"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9]/g, '');
                }
            }else if(val=="alpha_digit_space"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 ]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9 ]/g, '');
                }
            }else if(val=="alpha_space"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 ]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z ]/g, '');
                }
            }else if(val=="alpha_digit_space_hifun"){
                if(document.getElementById(el).value.match(/[^a-zA-Z0-9 -]/g)) {
                    document.getElementById(el).value = document.getElementById(el).value.replace(/[^a-zA-Z0-9 -]/g, '');
                }
            }
        },


        regx:function(elem){
            if(elem == 'mobile'){
                return /^[0-9]{4,12}$/;
            }else if(elem == 'email'){
                return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
            }else if(elem == 'only_alpha'){
                return /^[a-zA-Z]+$/;
            }else if(elem == 'only_digit'){
                return /^[0-9]+$/;
            }else if(elem == 'int_flot'){
                return /^(?=.*\d)\d*(?:\.\d+)?$/;
            }else if(elem == 'only_alpha_number'){
                return /^[a-zA-Z0-9]+$/;
            }else if(elem == 'only_alpha_space'){
                return /^[a-zA-Z ]+$/;
            }else if(elem == 'url'){
                return /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
            }else if(elem == 'number'){
                return /^[0-9]{1,6}$/;
            }else if(elem == 'only_alpha_number_space') {
                return /^[a-zA-Z0-9 ]+$/;
            }else if(elem == 'only_alpha_number_space_hifun') {
                return /^[a-zA-Z0-9 -]+$/;
            }else if(elem == 'only_alpha_number_hifun') {
                return /^[a-zA-Z0-9-]+$/;
            }else if(elem== 'url_general'){
                //return /(https|http|ftp)\:\/\/|([a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4})|([a-z0-9A-Z]+\.[a-zA-Z]{2,4})|\?([a-zA-Z0-9]+[\&\=\#a-z]+)/i;
                return /^((https|http|ftp)\:\/\/|)?([\da-z-]+\.)+([a-z]{2,6})?(\/([a-z0-9+\$_-]\.?)+)*\/?$/
            }else if(elem== 'numeric_3_decimal_point'){
                return /^\d+(\.\d{1,3})?$/;
            }else if(elem== 'numeric_2_decimal_point_with_postfix'){
                return /^\d+(\.\d{1,2})?ct\b$/;
            }else if(elem == 'only_english_cher') {
                return /^[a-zA-Z0-9 !@#%*()_+-=]+$/;
            }else if(elem== 'digit_with_two_decimal'){
                return /^\d+(\.\d{1,2})?$/;
            }else if(elem== 'digit_with_three_decimal'){
                return /^\d+(\.\d{1,3})?$/;
            }else if(elem=='gst_no'){
                return /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            }
        },
        scroll_upto_div:function(element_id){
            $("html, body").animate({
                scrollTop: $("#"+element_id).offset().top-180
            }, 600);
        },

        get_page_name:function(url) {
            var index = url.lastIndexOf("/") + 1;
            var filenameWithExtension = url.substr(index);
            var filename = filenameWithExtension.split(".")[0];
            return filename;
        },

        replace_strinng:function(){
        },

        getCookie:function(cname){
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length,c.length);
                }
            }
            return "";
        },
        setTimeOutAlerts:function(){
            setTimeout(function() {
                //$(".alert").css("display", "none");
                $('.alert').each(function () {
                    if($(this).attr('role')=='alert'){
                        $(this).fadeOut();
                    }
                });
            }, 5000);
        },

        // Used for print console data
        console_log : function(console_data)
        {
            if(console_log_flag == true)
            {
                console.log(console_data);
            }
        },
        callfunction : function(fn, args)
        {
            fn = (typeof fn == "function") ? fn : window[fn];  // Allow fn to be a function object or the name of a global function
            return fn.apply(this, args||[]);  // args is optional, use an empty array by default
        }


        /* Function : callajax
         *      Parameters :
         *                  1)url : url
         *                  2)data : data
         *                  3)datatype : (default: Intelligent Guess (xml, json, script, or html))
         *                  4)method : GET,POST or PUT
         *                  5)asynctype : true or false (//Synchronous ( async: false ) – Script stops and waits for the server to send back a reply before continuing.)
         *                  6)hdnfunction: hide the function
         *                  7) args : arguments for the functions
         *
         */
        /*callajaxreturn : function(url,data,datatype,method,asynctype,hdnfunction,args)
         {

         args=args||[];
         if(datatype == undefined || datatype == '') datatype = 'html';
         if(method == undefined || method == '') method = 'GET';

         if(asynctype != undefined || asynctype != '')
         {
         asynctype = asynctype;
         }
         else
         {
         asynctype = true;
         }

         *//*if(asynctype == undefined || asynctype == '')
         {
         asynctype = true;
         }*//*


         var returnresponse;

         returnresponse = false;
         //$(".ajaxloader").show();

         // alert(url);

         var reponse_type;


         $.ajax({
         url: url,
         method: method,
         data: data,
         dataType: datatype,
         async: asynctype,
         processData: false,
         contentType: false,
         // beforeSend: function(){ $("#btnLogin").html('Connecting...');},
         success: function(responce)
         {
         reponse_type = true;
         returnresponse = responce;
         },
         error: function (jqXHR, exception) {
         reponse_type = false;
         var msg = '';
         if (jqXHR.status === 0) {
         msg = 'Not connect.\n Verify Network.';
         } else if (jqXHR.status == 404) {
         msg = 'Requested page not found. [404]';
         } else if (jqXHR.status == 500) {
         msg = 'Internal Server Error [500].';
         } else if (exception === 'parsererror') {
         msg = 'Requested JSON parse failed.';
         } else if (exception === 'timeout') {
         msg = 'Time out error.';
         } else if (exception === 'abort') {
         msg = 'Ajax request aborted.';
         } else {
         msg = 'Uncaught Error.\n' + jqXHR.responseText;
         }
         $('#post').html(msg);
         }
         });
         *//* var response = {
         "reponsetype" : reponse_type,
         "reponse" : returnresponse
         };*//*
         return returnresponse;
         //return returnresponse;
         }*/
    };
}();