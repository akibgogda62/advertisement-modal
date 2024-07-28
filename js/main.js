jQuery(document).ready(function($) {
    // Show the modal on page load
    if (!getCookie('modalClosed')) {
        $('.agc-modal').fadeIn();
    }

    // Close modal when close button is clicked
    $('.close-modal').click(function() {
        $('.agc-modal').fadeOut();
        setCookie('modalClosed', 'true', modalCookieStoreTime);
    });
});


// Function to set a cookie
function setCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
}

// Function to get the value of a cookie
function getCookie(name) {
    var nameEQ = name + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}