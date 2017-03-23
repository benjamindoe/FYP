window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

import 'jquery-ui/ui/widgets/datepicker.js';
import 'jquery-ui/ui/widgets/sortable.js';

require('bootstrap-sass');

window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

window.ProgressBar = require('progressbar.js');

window.DialogPolyfill = require('dialog-polyfill');

window.Chart = require('chart.js');