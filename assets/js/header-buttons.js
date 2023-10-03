// Checks if document is loaded
const performWhenDocumentIsLoaded = callback => {
    if (/comp|inter|loaded/.test(document.readyState))
        callback();
    else
        document.addEventListener('DOMContentLoaded', callback, false);
}

performWhenDocumentIsLoaded(() => {

    /* Botão de Acessibilidade */
    const toggleA11yButton = document.getElementById('cmc-a11y-toolbar-toggle-link');

    if ( toggleA11yButton ) {
        toggleA11yButton.addEventListener('click', function(e) {
            e.preventDefault();
            const a11yToolbar = document.getElementById('pojo-a11y-toolbar');
            
            if ( a11yToolbar.classList.contains('pojo-a11y-toolbar-open') )
                a11yToolbar.classList.remove('pojo-a11y-toolbar-open');
            else
                a11yToolbar.classList.add('pojo-a11y-toolbar-open');
        });
    }

    /* Botão do VLibras */
    const toggleVLibrasButton = document.getElementById('cmc-vlibras-button');

    if ( toggleVLibrasButton ) {
        toggleVLibrasButton.addEventListener('click', function(e) {
            e.preventDefault();
            const vLibrasButton = document.querySelector('[vw-access-button] .access-button')
            if ( vLibrasButton ) vLibrasButton.click();
        });
    }

    /* Watch Scroll position to display floating buttons */
    let scrollPosition = window.scrollY;
    const floatingVLibrasButton = document.querySelector('[vw-access-button]');
    const floatingA11yButton = document.querySelector('.pojo-a11y-toolbar-toggle');
    const floatingGTranslateButton = document.querySelector('#gt_float_wrapper');

    if ( scrollPosition < 230 ) {
        if ( floatingVLibrasButton ) floatingVLibrasButton.style.display = 'none';
            
        if ( floatingA11yButton ) floatingA11yButton.style.display = 'none';

        if ( floatingGTranslateButton ) floatingGTranslateButton.style.display = 'none';
    }

    window.addEventListener('scroll', function() {

        if ( !floatingVLibrasButton )
            floatingVLibrasButton = document.querySelector('[vw-access-button]'); // Checking this again as it might not have loaded

        scrollPosition = window.scrollY;

        if ( scrollPosition >= 230 ) {

            if ( floatingVLibrasButton.style.display !== 'flex' ) floatingVLibrasButton.style.display = 'flex';
            
            if ( floatingA11yButton.style.display !== 'block' ) floatingA11yButton.style.display = 'block';

            if ( floatingGTranslateButton.style.display !== 'block' ) floatingGTranslateButton.style.display = 'block';

        } else {

            if ( floatingVLibrasButton.style.display !== 'none' ) floatingVLibrasButton.style.display = 'none';
            
            if ( floatingA11yButton.style.display !== 'none' ) floatingA11yButton.style.display = 'none';

            if ( floatingGTranslateButton.style.display !== 'none' ) floatingGTranslateButton.style.display = 'none';

        }
    

    });
});