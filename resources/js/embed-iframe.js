/** @var {import('iframe-resizer').iframeResizer} iFrameResize')} */
// noinspection JSFileReferences
import iFrameResize from 'iframe-resizer/js/iframeResizer.js';

window.handleEmbedIframeLoaded = function handleEmbedIframeLoaded(iframe) {
    const dom = document.createElement('div');
    dom.innerHTML = iframe.srcdoc;
    const isFullWidth = dom.querySelector('iframe') && dom.querySelector('iframe').width === '100%';

    if(isFullWidth) {
        iframe.width = '100%';
    }

    iFrameResize({
        heightCalculationMethod: 'documentElementOffset',
        sizeWidth: !isFullWidth,
        checkOrigin: false,
    }, iframe);
}

console.log('test');
