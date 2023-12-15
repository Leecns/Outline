import QRCodeStyling from "qr-code-styling";

const options = {
    width: 300,
    height: 300,
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
        color: getComputedStyle(document.documentElement).getPropertyValue('--qr-code-text'),
        gradient: null
    },
    backgroundOptions: {
        color: getComputedStyle(document.documentElement).getPropertyValue('--qr-code-bg'),
        gradient: null
    },
    cornersSquareOptions: {
        type: "extra-rounded",
        color: getComputedStyle(document.documentElement).getPropertyValue('--qr-code-text'),
        gradient: null
    },
    cornersDotOptions: {
        type: "",
        color: getComputedStyle(document.documentElement).getPropertyValue('--qr-code-text'),
        gradient: null
    },
};

export default function createQRCode(data, logoUrl, canvasSelector) {
    const qrCode = new QRCodeStyling({...{ data, image: logoUrl }, ...options});

    qrCode.append(document.querySelector(canvasSelector));
};
