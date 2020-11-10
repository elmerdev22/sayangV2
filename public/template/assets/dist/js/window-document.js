var window_frame = function window_frame(filters=[], url){
    var window_url = url+'?'+$.param(filters);
    open_window_frame(window_url);
}

var open_window_frame = function open_window_frame(url, title){
    var newWindow = window.open(url, title,"width="+screen.availWidth+",height="+screen.availHeight);
    newWindow.document.close();
    newWindow.focus();
    // newWindow.print();
    // newWindow.close();
}