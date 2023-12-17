
import createQRCode from "./qr-code.js";

window.addEventListener('load', () => {
   window.createQRCode = createQRCode;
});


/*

Example to create QR Code

const intervalId = setInterval(() => {
    if (!window.createQRCode)
        return;

    clearInterval(intervalId);
    window.createQRCode('ss://YWVzLTE5Mi1nY206VWdHZ2xRYXdrUVEydnZzV0dRVTZzcA@127.0.0.1:4532/?outline=1#test', '{{ asset('favicon.svg') }}', '#canvas');
}, 100);

*/
