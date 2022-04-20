window._ = require('lodash');


try {
    window.axios= require('axios');
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('admin-lte');

} catch (e) {
}
