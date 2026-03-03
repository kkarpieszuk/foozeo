/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./src/faq-accordion/view.js ***!
  \***********************************/
/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

// #region agent log
(function () {
  var endpoint = 'http://127.0.0.1:7297/ingest/22bb9dcb-32a6-4085-8559-80fc14b36a5a';
  var sessionId = '200873';
  function send(payload) {
    try {
      fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Debug-Session-Id': sessionId
        },
        body: JSON.stringify(Object.assign({
          sessionId: sessionId,
          timestamp: Date.now()
        }, payload))
      }).catch(function () {});
    } catch (e) {}
  }
  var wrapper = document.querySelector('.wp-block-foozeo-faq-accordion');
  var items = document.querySelectorAll('.wp-block-accordion-item');
  var itemsInsideWrapper = wrapper ? wrapper.querySelectorAll('.wp-block-accordion-item').length : 0;
  send({
    location: 'view.js:init',
    message: 'faq-accordion view ran',
    hypothesisId: 'H2',
    runId: 'post-fix',
    data: {
      wrapperExists: !!wrapper,
      wrapperDataWpInteractive: wrapper ? wrapper.getAttribute('data-wp-interactive') : null,
      wrapperDataWpContext: wrapper ? wrapper.getAttribute('data-wp-context') : null,
      accordionItemsCount: items.length,
      accordionItemsInsideWrapper: itemsInsideWrapper
    }
  });
  send({
    location: 'view.js:init',
    message: 'H1/H4 wrapper attributes',
    hypothesisId: 'H1',
    data: {
      wrapperHasInteractive: !!(wrapper && wrapper.getAttribute('data-wp-interactive')),
      wrapperHTMLSnippet: wrapper ? wrapper.outerHTML.substring(0, 400) : 'no wrapper'
    }
  });
  setTimeout(function () {
    var btn = document.querySelector('.wp-block-accordion-heading__toggle');
    var storeExists = typeof window.wp !== 'undefined' && window.wp.interactivity;
    send({
      location: 'view.js:afterDelay',
      message: 'H3/H5 after 500ms',
      hypothesisId: 'H3',
      data: {
        storeExists: !!storeExists,
        hasToggleButton: !!btn,
        buttonHasDataWpClick: btn ? !!btn.getAttribute('data-wp-on--click') : false,
        wpInteractivityState: typeof window.wp !== 'undefined' && window.wp.interactivity ? 'exists' : 'missing'
      }
    });
  }, 500);
})();
// #endregion agent log
/******/ })()
;
//# sourceMappingURL=view.js.map