let spiner = "<i class='fa fa-spin fa-spinner'></i>";

// get url from meta data
function url(param){
    let uri = document.querySelector('meta[name=url]').getAttribute('content');
    return uri+'/'+param;
}

var interval;

function timer(time, callback) {
    interval = setInterval(function () {
        time -= 1;
        time <= 0 && clearInterval(interval) | callback()
    }, 1000);
}

function toast(msg) {
    if (msg == undefined) {
        msg = ''
    }
    $('.fn-toast').remove();
    $('body').append('<div class="fn-toast toastSlide"> ' + msg + ' </div>');

    clearInterval(interval);
    timer(5, function () {
        $('.fn-toast').fadeOut(500);
    });
}

function goTo(url, time = 500){
    setTimeout(() => {
        url == 'reload' ? location.reload() : location.href = url;
    }, time);
}

$.fn.par = function (num) {
    var elem = [];
    this.each(function () {
        var el = this;
        while (num > 0) {
            if (el.parentNode) el = el.parentNode;
            num--;
        }
        elem.push(el);
    });
    return $(elem || this);
};

Array.prototype.pull = function() {
	var what, a = arguments, L = a.length, ax;
	while (L && this.length) {
		what = a[--L];
		while ((ax = this.indexOf(what)) !== -1) {
			this.splice(ax, 1);
		}
	}
	return this;
}

$(document).ready(function(){

    $('[number-only]').on('keypress', function(e){
        if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });

})

function previewImg(input, viewOn) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#'+viewOn).attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}