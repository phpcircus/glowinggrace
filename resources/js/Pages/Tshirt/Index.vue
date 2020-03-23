<template>
    <layout title="Purchases">
        <admin-sub-layout>
            <div class="flex flex-col font-opensans bg-white shadow-md container mx-auto max-w-7xl">
                <div class="flex flex-col w-full p-6">
                    <div class="flex items-center ml-auto mb-4">
                        <span v-if="! showAll" class="text-xs md:text-sm text-gray-600 font-semibold italic mr-4">( Showing orders not yet delivered )</span>
                        <span v-if="showAll" class="text-xs md:text-sm text-gray-600 font-semibold italic mr-4">( Showing all orders )</span>
                        <span v-if="showAll" class="btn btn-muted btn-sm text-teal-500 cursor-pointer" @click="showNotDeliveredOrders()">Show Not Delivered</span>
                        <span v-if="! showAll" class="btn btn-muted btn-sm text-teal-500 cursor-pointer" @click="showAllOrders()">Show All</span>
                    </div>
                    <div v-for="purchase in orders" :key="purchase.id" class="flex flex-col md:flex-row mb-4 border-b border-gray-500 py-2 last:border-0">
                        <div class="flex flex-row md:flex-col w-full md:w-1/4">
                            <h1 class="text-lg text-gray-800 font-semibold mr-2">
                                {{ purchase.customer.name }}
                            </h1>
                            <span class="text-base text-teal-500 ml-auto md:ml-0">
                                {{ purchase.readable_total }}
                            </span>
                        </div>
                        <span v-if="! purchase.delivered" class="text-base text-gray-600 mr-2 mb-2 md:mb-0 w-full md:w-1/4"> {{ purchase.method == 'shipped' ? 'to ship' : `pick up in ${purchase.pickup_location}` }}</span>
                        <span v-if="purchase.delivered" class="text-base text-gray-600 mr-2 w-full md:w-1/4"> {{ purchase.method == 'shipped' ? 'shipped' : `picked up in ${purchase.pickup_location}` }}</span>
                        <div class="flex flex-col w-full md:w-1/4">
                            <span v-for="item in purchase.line_items" :key="item.id" class="flex flex-row md:flex-col text-sm text-gray-800 mb-2">
                                <div class="flex">
                                    <span class="font-semibold">size: </span><span class="mr-3">{{ item.size.slug }} ({{ item.quantity }})</span>
                                </div>
                            </span>
                        </div>
                        <inertia-link class="flex items-center md:px-3 py-2 text-teal-500 hover:text-teal-300 text-base group w-full md:w-1/4" :href="route('admin.tshirts.show', purchase.id)">
                            <icon-base width="14" height="14" icon-fill="fill-teal-600" icon-name="view" classes="mr-2 group-hover:fill-teal-400">
                                <view-eye />
                            </icon-base>
                            View Order
                        </inertia-link>
                    </div>
                    <div v-if="! purchases.length" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-2 py-3">
                        <h1 class="text-lg text-gray-800 font-semibold">
                            No purchases found.
                        </h1>
                    </div>
                </div>
            </div>
        </admin-sub-layout>
    </layout>
</template>

<script>
import AdminSubLayout from '@/Shared/AdminSubLayout';
import { filter } from 'lodash';
import IconBase from '@/Shared/IconBase';
import Layout from '@/Shared/Layout';
import ViewEye from '@/Shared/Icons/ViewEye';

export default {
    components: {
        Layout,
        ViewEye,
        IconBase,
        AdminSubLayout,
    },
    props: {
        purchases: {
            type: [Array, Object],
            default: () => [],
        },
    },
    data () {
        return {
            showAll: false,
            orders: {},
        }
    },
    created () {
        this.showNotDeliveredOrders();
    },
    methods: {
        showNotDeliveredOrders () {
            this.orders = filter(this.purchases, purchase => {
                return purchase.delivered == false;
            });
            this.showAll = false;
        },
        showAllOrders () {
            this.orders = this.purchases;
            this.showAll = true;
        },
    },
}
</script>
