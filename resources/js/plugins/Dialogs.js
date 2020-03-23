import Hub from 'Events/hub';

export default {
    install (Vue, options) {
        Vue.prototype.$showDialog = (level, amount, callback) => {
            Vue.prototype.$modal.show('dialogModal', {
                title: level === 'warning' ? 'Caution!' : 'Notice',
                text: `Your total is $${amount}, proceed?`,
                buttons: [
                    {
                        title: 'Proceed',
                        type: 'create',
                        handler: callback,
                    },
                    {
                        title: 'Close',
                        type: 'close',
                        handler: () => {
                            Vue.prototype.$modal.hide('dialogModal');
                            Hub.$dispatch('purchaseFormReady');
                        },
                    },
                ],
            });
        };

        Vue.prototype.$hideDialog = () => Vue.prototype.$modal.hide('dialogModal');
    },
}
