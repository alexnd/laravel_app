import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

window.copyToClipboard = function (selector) {
    var el = document.querySelector(selector);
    if (el) {
        var s = el.value || el.innerText || el.innerHTML || '';
        if (navigator && navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(s).then(function() {
                window.copyToClipboard._value = s;
            }).catch(function() {
                window.copyToClipboard._value = '';
            });
            return true;
        } else if (document.execCommand) {
            var _ = document.createElement('textarea');
            _.value = s;
            _.setAttribute('readonly', '');
            _.style.position = 'absolute';
            _.style.left = '-9999px';
            document.body.appendChild(_);
            _.select();
            document.execCommand('copy');
            document.body.removeChild(_);
            window.copyToClipboard._value = s;
            return true;
        }
    }
    return false;
}
window.copyToClipboard._value = '';
