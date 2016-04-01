
$( document ).ready(function() {


    var dialog = $("#loadDiv").dialog({  //create dialog, but keep it closed
        autoOpen: false,
        height: 200,
        width: 1000,
        modal: true
    });

    $( document ).ajaxStart(function() {
        $( ".log" ).text( "Triggered ajaxStart handler." );
        showloadingDialog();
    });

    $( document ).ajaxStop(function() {
        $( ".log" ).text( "Triggered ajaxStop handler." );
        hideloadingDialog();
    });

    function showloadingDialog(){  //load content and open dialog
        $(dialog).dialog("open");
        $(dialog).dialog( "moveToTop" );
    }

    function hideloadingDialog(){  //load content and open dialog
        $(dialog).dialog("close");
    }

});

function ajax_download(url, data, input_name) {
    var $iframe,
        iframe_doc,
        iframe_html;

    if (($iframe = $('#download_iframe')).length === 0) {
        $iframe = $("<iframe id='download_iframe'" +
            " style='display: none' src='about:blank'></iframe>"
        ).appendTo("body");
    }

    iframe_doc = $iframe[0].contentWindow || $iframe[0].contentDocument;
    if (iframe_doc.document) {
        iframe_doc = iframe_doc.document;
    }

    iframe_html = "<html><head></head><body><form method='POST' action='" +
    url +"'>" +
    "<input type=hidden name='" + input_name + "' value='" +
    JSON.stringify(data) +"'/></form>" +
    "</body></html>";

    iframe_doc.open();
    iframe_doc.write(iframe_html);
    $(iframe_doc).find('form').submit();
}
