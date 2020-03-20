import _ from 'lodash';
import axios from 'axios';
import moment from 'moment';

export default {
    computed: {
        Wink() {
            return Wink;
        }
    },


    methods: {
        /**
         * Determine if the given date is in the future.
         */
        dateInTheFuture(date) {
            return moment().diff(moment(date + ' Z'), 'minutes') < 0;
        },


        /**
         * Show the time ago format for the given time.
         */
        timeAgo(time) {
            return moment(time + ' Z').utc().local().fromNow();
        },


        /**
         * Show the time in local time.
         */
        localTime(time) {
            return moment(time + ' Z').utc().local().format('MMMM Do YYYY, h:mm:ss A');
        },


        /**
         * Truncate the given string.
         */
        truncate(string, length = 70) {
            return _.truncate(string, {
                'length': length,
                'separator': /,? +/
            });
        },


        /**
         * Creates a debounced function that delays invoking a callback.
         */
        debouncer: _.debounce(callback => callback(), 500),


        /**
         * Convert string to slug.
         *
         * src: https://gist.github.com/mathewbyrne/1280286
         */
        slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-');
        },
    }
};
