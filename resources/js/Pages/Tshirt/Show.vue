<template>
    <layout :title="`Order for ${ order.customer.name }`">
        <div class="flex flex-col">
            <h1 class="mb-8 font-bold text-xl md:text-2xl text-gray-800">
                <inertia-link class="text-purple-400 hover:text-purple-700" :href="route('admin.tshirts.index')">Tshirt Orders</inertia-link>
                <span class="font-semibold">/</span>
                {{ order.customer.name }}
            </h1>
            <div class="bg-white rounded shadow overflow-hidden max-w-lg">
                <form class="w-full" @submit.prevent="submit">
                    <div class="p-8 flex flex-col">
                        <div class="flex w-full mb-4">
                            <div class="flex flex-col">
                                <span v-for="item in order.line_items" :key="item.id" class="text-sm text-gray-800 mb-2 last:mb-0">
                                    <span class="font-semibold">SIZE: </span><span class="font-normal mr-3">{{ item.size.slug }}</span>
                                    <span class="font-semibold">QTY: </span><span class="font-normal mr-3">{{ item.quantity }}</span>
                                </span>
                            </div>
                            <span class="text-teal-500 ml-auto font-bold">{{ order.readable_total }}</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-sm text-gray-600 font-semibold w-160p">DELIVERY METHOD:</span>
                            <span class="font-normal">{{ order.method }}</span>
                        </div>
                        <div v-if="order.method == 'shipped'" class="flex flex-col mb-4">
                            <span class="text-sm text-teal-500 font-semibold">{{ order.address }}</span>
                            <span class="text-sm text-teal-500 font-semibold">{{ order.city }}, {{ order.state }} {{ order.zip }}</span>
                        </div>
                        <div v-if="order.method == 'pickup'" class="flex items-center mb-4">
                            <span class="text-sm text-gray-800 font-semibold w-160p">PICKUP LOCATION: </span>
                            <span class="text-sm text-gray-800 font-normal" v-text="order.pickup_location == 'irving' ? 'Irving, TX' : 'Senatobia, MS'" />
                        </div>
                        <checkbox v-model="delivered" class="pb-4 text-lg w-full lg:w-1/2" label="DELIVERY COMPLETE? " :width="4" :height="4" :checked="!!delivered" />
                        <div class="flex items-center border-t border-gray-300 pt-8">
                            <loading-button :loading="sending" class="ml-auto btn btn-blue" type="submit">Update Order</loading-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </layout>
</template>

<script>
import Checkbox from '@/Shared/Checkbox';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        Layout,
        Checkbox,
        LoadingButton,
    },
    props: {
        order: Object,
    },
    data () {
        return {
            sending: false,
            delivered: false,
        }
    },
    created () {
        this.delivered = this.order.delivered;
    },
    methods: {
        submit () {
            if (this.delivered != this.order.delivered) {
                this.$inertia.post(this.route('admin.tshirts.update', this.order.id), { delivered: !!this.delivered });
            }
        },
    },
}
</script>
