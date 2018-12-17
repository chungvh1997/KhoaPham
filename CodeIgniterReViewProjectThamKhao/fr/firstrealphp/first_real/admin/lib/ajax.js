// JavaScript Document

function makerequest(page, str, method, resultID) {
    var x = createxmlhttpRequest();
    var res = document.getElementById(resultID);

    if (method == 'get') {
        x.open("GET", page + "?" + str);
        x.onreadystatechange = function () {
            if (res.innerHTML)
                res.innerHTML = x.responseText;
            else
                res.value = x.responseText;
        }
        x.send(null);
    }
    else {
        x.open("POST", page, true);
        x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
        x.onreadystatechange = function () {
            if (x.readyState == 4 && x.status == 200) {
                if (res.innerHTML)
                    res.innerHTML = x.responseText;
                else
                    res.value = x.responseText;
            }
        }
        x.send(str);
    }
}

function createxmlhttpRequest() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        //alert ("You are using Microsoft Internet Explorer.");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            //alert ("You are using Microsoft Internet Explorder");
        } catch (E) {
            xmlhttp = false;
        }
    }

    //If we are using a non-IE browser, create a javascript instance of the object.
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
        //alert ("You are not using Microsoft Internet Explorer");
    }

    return xmlhttp;
}

//---------------------------------------------------------- getFormValues

function getFormValues(formID) {
    var f = document.getElementById(formID);
    var el = f.elements;
    var str = "";

    for (var i = 0; i < el.length; i++) {
        if (el[i].name == "")
            continue;
        //button
        if (el[i].type == "button")
            continue;
        //checkbox
        if (el[i].type == "checkbox" || el[i].type == "radio") {
            if (el[i].checked == true)
                str += el[i].name + "=" + escape(el[i].value) + "&";
            continue;
        }
        //select
        if (el[i].type == "select-one") {
            if (el[i].value != "")
                str += el[i].name + "=" + escape(el[i].value) + "&";
            continue;
        }

        str += el[i].name + "=" + escape(el[i].value) + "&";
    }

    //alert(str);
    return str;
}