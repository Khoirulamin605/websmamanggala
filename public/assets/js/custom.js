



// ==============================================================
// Popup Banner
// ==============================================================
function showBanner(link) {
    $.magnificPopup.open({
        items: {
        src: link,
        },
        type: 'image',
        mainClass: 'mfp-with-zoom',
        closeBtnInside: true
    });
}

