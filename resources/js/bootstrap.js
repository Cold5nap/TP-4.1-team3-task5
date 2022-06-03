window._ = require('lodash');

try {
    window.axios= require('axios');
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle');

} catch (e) {
}