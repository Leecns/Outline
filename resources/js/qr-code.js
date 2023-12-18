import QRCodeStyling from "qr-code-styling";

const bodyCss = getComputedStyle(document.documentElement);
const size = bodyCss.getPropertyValue('--qr-code-size').replace('px', '');
const bgBrush = bodyCss.getPropertyValue('--qr-code-bg');
const textBrush = bodyCss.getPropertyValue('--qr-code-text');

const options = {
    width: size,
    height: size,
    margin: 4,
    qrOptions: {
        typeNumber: "6",
        mode: "Byte",
        errorCorrectionLevel: "M"
    },
    imageOptions: {
        hideBackgroundDots: true,
        imageSize: 0.4,
        margin: 8
    },
    dotsOptions: {
        type: "extra-rounded",
        color: textBrush,
        gradient: null
    },
    backgroundOptions: {
        color: bgBrush,
        gradient: null
    },
    cornersSquareOptions: {
        type: "extra-rounded",
        color: textBrush,
        gradient: null
    },
    cornersDotOptions: {
        type: "",
        color: textBrush,
        gradient: null
    },
};

window.addEventListener('load', () => {
    window.createQRCode = function(data, logoUrl, containerElSelector) {
        const qrCode = new QRCodeStyling({...{ data, image: logoUrl }, ...options});

        const container = document.querySelector(containerElSelector);
        container.innerHTML = '';

        qrCode.append(container);
    };
});
