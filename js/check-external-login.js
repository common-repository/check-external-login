document.addEventListener("DOMContentLoaded", function () {
    checkExternalLogin.checkLogged();
});

checkExternalLogin = {
    textClass: 'js-cel-text-',
    linkClass: 'js-cel-link-',
    url: typeof celUrl != 'undefined' ? celUrl : null,
    checkLogged: function () {
        if (checkExternalLogin.url) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = checkExternalLogin.url + '?callback=checkExternalLogin.callback';

            document.head.appendChild(script);
        }
    },
    callback: function (data) {
        let notConnectedElements = document.querySelectorAll('.js-cel-not-connected');
        let connectedElements = document.querySelectorAll('.js-cel-connected');
        let textElements = document.querySelectorAll("[class*='" + checkExternalLogin.textClass + "']");
        let linkElements = document.querySelectorAll("[class*='" + checkExternalLogin.linkClass + "']");

        if ( !data.text ) {
            data.text = [];
        }

        if ( !data.link ) {
            data.link = [];
        }

        // Toggle not connected elements
        notConnectedElements.forEach(function (notConnectedElement) {
            notConnectedElement.classList.toggle('d-none', data.connected);
        });

        // Toggle connected elements
        connectedElements.forEach(function (connectedElement) {
            connectedElement.classList.toggle('d-none', !data.connected);
        });

        // Fill text elements or empty if not return by JSONP
        textElements.forEach(function (textElement) {
            let textName = '';

            // Find class name
            textElement.classList.forEach(function (className) {
                if (className.startsWith(checkExternalLogin.textClass)) {
                    textName = className.replace(checkExternalLogin.textClass, '');
                }
            });

            textElement.innerHTML = data.text[textName] ?? '';
        });

        // Fill href of link elements or empty if not return by JSONP
        linkElements.forEach(function (linkElement) {
            let linkName = '';

            // Find class name
            linkElement.classList.forEach(function (className) {
                if (className.startsWith(checkExternalLogin.linkClass)) {
                    linkName = className.replace(checkExternalLogin.linkClass, '');
                }
            });

            linkElement.setAttribute('href', data.link[linkName] ?? '');
        });
    }
};
