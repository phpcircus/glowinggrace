<template>
    <layout title="Team Kimberlyn">
        <div class="flex flex-col bg-white shadow-md container mx-auto max-w-7xl">
            <div class="px-6 pb-8">
                <div class="w-full flex flex-col md:flex-row justify-center mt-2">
                    <img src="/img/black_shirt.jpg" class="w-full md:w-1/3 h-auto border-4 border-gray-400 rounded shadow">
                    <img src="/img/gray_shirt.jpg" class="w-full md:w-1/3 h-auto border-4 border-gray-400 rounded shadow">
                </div>
                <div class="font-opensans flex flex-col text-sm italic text-gray-600 font-semibold text-center w-full">
                    <div class="flex self-center">
                        <span class="mr-4">Shirt sizes YS to AXL: <span class="font-bold">$20</span></span>
                        <span class="mr-4">XXL:  <span class="font-bold">$21</span></span>
                        <span class="mr-4">XXXL:  <span class="font-bold">$22</span></span>
                    </div>
                    <span class="mr-4 text-teal-500 font-bold">For shipped orders, the final cost includes $5 to cover shipping.</span>
                </div>
            </div>
            <div class="bg-purple-200">
                <div class="flex flex-col md:flex-row p-6 mt-2">
                    <div class="flex flex-col flex-wrap h-540p w-full md:w-1/2">
                        <div v-for="size in $page.app.sizes" :key="size.id" class="flex flex-col mb-2">
                            <div class="flex items-center">
                                <span class="inline-block align-middle text-sm mr-4 w-80p md:w-120p">{{ size.color }} - {{ size.abbr }}</span>
                                <text-input v-model="sizes[size.slug]" type="number" :step="1" class="w-60p" />
                            </div>
                        </div>
                    </div>
                    <form ref="form" class="w-full md:w-1/2 my-6" @submit.prevent="purchase()">
                        <label class="stripe">
                            <span :class="errorType === 'name' ? 'text-red-500' : ''">Name</span>
                            <input v-model="extraDetails.name" name="name" class="stripe-field" placeholder="Jane Doe" required>
                        </label>
                        <label class="stripe">
                            <span :class="errorType === 'phone' ? 'text-red-500' : ''">Phone</span>
                            <input v-model="phone" class="stripe-field" placeholder="(123) 456-7890" type="tel">
                        </label>
                        <label class="stripe">
                            <span :class="errorType === 'email' ? 'text-red-500' : ''">Email</span>
                            <input v-model="email" class="stripe-field" placeholder="jdoe@company.com" type="email">
                        </label>
                        <div class="mt-4">
                            <span class="text-gray-600" :class="errorType === 'deliveryType' ? 'text-red-500' : ''">Delivery Type</span>
                            <div class="flex mt-2">
                                <label class="stripe inline-flex items-center">
                                    <input v-model="deliveryType" type="radio" class="form-radio" name="deliveryType" value="shipped">
                                    <span class="ml-2">Shipped</span>
                                </label>
                                <label class="stripe inline-flex items-center ml-6">
                                    <input v-model="deliveryType" type="radio" class="form-radio" name="deliveryType" value="pickup">
                                    <span class="ml-2">Pick up</span>
                                </label>
                            </div>
                        </div>
                        <div v-if="deliveryType === 'shipped'" class="mt-4">
                            <label class="stripe">
                                <span :class="errorType === 'address' ? 'text-red-500' : ''">Address</span>
                                <input v-model="address" class="stripe-field" placeholder="123 Easy St. Apt. 342" type="tel" required>
                            </label>
                            <label class="stripe">
                                <span :class="errorType === 'city' ? 'text-red-500' : ''">City</span>
                                <input v-model="city" class="stripe-field" placeholder="Westchestersonfieldville" type="tel" required>
                            </label>
                            <label class="stripe">
                                <span :class="errorType === 'state' ? 'text-red-500' : ''">State</span>
                                <input v-model="state" class="stripe-field" placeholder="MS" type="tel" required>
                            </label>
                        </div>
                        <label class="stripe">
                            <span :class="errorType === 'zip' ? 'text-red-500' : ''">ZIP</span>
                            <input v-model="zip" class="stripe-field" placeholder="90210" type="tel" required>
                        </label>
                        <div v-if="deliveryType === 'pickup'" class="mt-4">
                            <span class="text-gray-600" :class="errorType === 'pickupLocation' ? 'text-red-500' : ''">Pickup Location</span>
                            <div class="flex mt-2">
                                <label class="stripe inline-flex items-center">
                                    <input v-model="pickupLocation" type="radio" class="form-radio" name="pickupLocation" value="irving">
                                    <span class="ml-2">Irving, TX</span>
                                </label>
                                <label class="stripe inline-flex items-center ml-6">
                                    <input v-model="pickupLocation" type="radio" class="form-radio" name="pickupLocation" value="senatobia">
                                    <span class="ml-2">Senatobia, MS</span>
                                </label>
                            </div>
                        </div>
                        <label class="stripe">
                            <span class="hidden md:inline" :class="errorType === 'card' ? 'text-red-500' : ''">Card</span>
                            <div id="card-element" ref="card" class="stripe-field" />
                        </label>
                        <div v-if="ready" class="flex items-center">
                            <button class="stripe" type="submit">Purchase</button>
                            <span v-if="total && total > 5" class="font-opensans text-lg text-teal-500 font-bold text-center w-full mt-2">
                                Your total is ${{ total }}
                            </span>
                        </div>
                        <svg v-else class="w-8 inline-block align-middle" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px" viewBox="0 0 128 128" xml:space="preserve"><path d="M0 128V83h17.25v27.75h93.5V83H128v45H0z" fill="#38c171" fill-opacity="1" /><g><path d="M80.92 210.95v-51.27h18.15L64 113.18l-35.07 46.5h18.15v51.27h33.84z" fill="#38c171" fill-opacity="1" /><animateTransform attributeName="transform" type="translate" from="0 0" to="0 -220" dur="1800ms" repeatCount="indefinite" /></g></svg>
                        <div class="stripe-outcome mt-4">
                            <div v-if="error" class="stripe-error bg-red-200 font-opensans text-red-500 rounded w-full font-semibold italic p-2 border border-red-500">{{ errorMessage }}</div>
                            <div v-if="success" class="stripe-success">
                                Success! Your Stripe token is <span class="token">{{ token }}</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <p class="font-opensans text-base text-gray-800 px-6 py-8">
                    Kimberlyn Stone was diagnosed in January with colorectal cancer.  She and Clay live in Irving, Texas.  They have a beautiful family that includes four children and a precious granddaughter. Kimberlyn was finally getting to pursue her lifelong dream of becoming a cosmetologist.  She was busy juggling work, school, church and family when they got this news and everything changed.  This is going to be a long, hard journey for all of them, family and friends included.  I have designed this tshirt as a reminder that Kimberlyn is never alone. <br><br>We are here for you and will keep you prayed up!  All the profits from these shirts will go to Clay and Kimberlyn to help with their financial needs throughout this fight!<br><br>
                    The t-shirts are bella canvas and will be available in both youth and adult sizes.  There are two colors to chose from black and gray.  You can choose to pick up locally with in Senatobia, MS or Irving, TX or have the shirt(s) shipped directly to you.  Within 24 hours of your purchase, you will receive a confirmation email with further details regarding your order. We will place the first order April 3.  Shirts should be delivered or shipped 3 weeks after the order is placed.<br><br>
                    Please reach out to Lauren Spencer at lauren.sbckids@gmail.com if you have any questions.  Thank you for your support and prayers for this precious family!
                </p>
            </div>
        </div>
    </layout>
</template>

<script>
import axios from 'axios';
import { config } from 'Config';
import { forEach } from 'lodash';
import Layout from '@/Shared/Layout';
import TextInput from '@/Shared/TextInput';

export default {
    components: {
        Layout,
        TextInput,
    },
    data () {
        return {
            stripe: undefined,
            elements: undefined,
            card: undefined,
            sizes: {
                blackys: 0,
                blackym: 0,
                blackyl: 0,
                blackyxl: 0,
                blacksm: 0,
                blackmd: 0,
                blacklg: 0,
                blackxl: 0,
                blackxxl: 0,
                blackxxxl: 0,
                grayys: 0,
                grayym: 0,
                grayyl: 0,
                grayyxl: 0,
                graysm: 0,
                graymd: 0,
                graylg: 0,
                grayxl: 0,
                grayxxl: 0,
                grayxxxl: 0,
            },
            prices: {
                blackys: 20,
                blackym: 20,
                blackyl: 20,
                blackyxl: 20,
                blacksm: 20,
                blackmd: 20,
                blacklg: 20,
                blackxl: 20,
                blackxxl: 21,
                blackxxxl: 22,
                grayys: 20,
                grayym: 20,
                grayyl: 20,
                grayyxl: 20,
                graysm: 20,
                graymd: 20,
                graylg: 20,
                grayxl: 20,
                grayxxl: 21,
                grayxxxl: 22,
            },
            style: {
                base: {
                    color: '#000',
                },
                invalid: {
                    color: '#fb040f',
                },
            },
            fonts: [
                {
                    family: 'Open Sans',
                    weight: 400,
                    src: 'local("Open Sans"), local("OpenSans"), local("open_sans"), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3ZBw1xU1rKptJj_0jans920.woff2) format("woff2")',
                    unicodeRange: 'U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215',
                },
            ],
            extraDetails: {
                name: null,
            },
            deliveryType: 'shipped',
            pickupLocation: null,
            phone: null,
            email: null,
            address: null,
            city: null,
            state: null,
            zip: null,
            success: false,
            error: false,
            errorType: '',
            token: null,
            errorMessage: null,
            money: {
                decimal: '.',
                thousands: ',',
                prefix: '$ ',
                suffix: '',
                precision: 2,
                masked: false,
            },
            ready: true,
        }
    },
    computed: {
        total () {
            return this.calculateTotal();
        },
    },
    created () {
        /* global Stripe */
        this.stripe = Stripe (`${config.stripe}`);
        this.elements = this.stripe.elements({
            fonts: this.fonts,
        });
        this.card = this.elements.create('card', {style: this.style});

        this.card.on('change', event => {
            this.processOutcome(event);
        });
    },
    mounted () {
        this.card.mount(this.$refs.card);
    },
    methods: {
        purchase () {
            this.ready = false;
            this.error = false;
            this.errorType = '';
            this.success = false;
            this.errorMessage = '';

            if (this.email === null) {
                this.error = true;
                this.errorMessage = 'Please provide an email address.';
                this.errorType = 'email';
                this.ready = true;

                return;
            }

            if (this.total <= 5) {
                this.error = true;
                this.errorMessage = 'Choose at least one tshirt color/size.';
                this.errorType = 'size';
                this.ready = true;

                return;
            }

            if (this.deliveryType === 'shipped' && this.address === null) {
                this.error = true;
                this.errorMessage = 'Please provide an address.';
                this.errorType = 'address';
                this.ready = true;

                return;
            }

            if (this.deliveryType === 'shipped' && this.city === null) {
                this.error = true;
                this.errorMessage = 'Please provide a city.';
                this.errorType = 'city';
                this.ready = true;

                return;
            }

            if (this.deliveryType === 'shipped' && this.state === null) {
                this.error = true;
                this.errorMessage = 'Please provide a state.';
                this.errorType = 'state';
                this.ready = true;

                return;
            }

            if (this.zip === null) {
                this.error = true;
                this.errorMessage = 'Please provide a zip code.';
                this.errorType = 'zip';
                this.ready = true;

                return;
            }

            if (this.deliveryType === 'pickup') {
                const options = ['irving', 'senatobia'];
                if (! options.includes(this.pickupLocation)) {
                    this.error = true;
                    this.errorMessage = 'Please choose a valid pickup location.';
                    this.errorType = 'pickupLocation';
                    this.ready = true;

                    return;
                }
            }

            let extraDetails = {
                name: this.extraDetails.name,
            };
            this.stripe.createToken(this.card, extraDetails).then(this.processOutcome);
        },
        processOutcome (result) {
            if (result.token) {
                this.token = result.token.id;
                axios.post(this.route('tshirt.purchase'), {
                    name: this.extraDetails.name,
                    phone: this.phone,
                    email: this.email,
                    address: this.address,
                    city: this.city,
                    state: this.state,
                    zip: this.zip,
                    deliveryType: this.deliveryType,
                    pickupLocation: this.pickupLocation,
                    sizes: this.sizes,
                    total: this.total,
                    token: result.token['id'],
                }).then( response => {
                    this.ready = true;
                    this.resetForm();
                    // this.$page.success.message = response.data.success;
                    this.$snotify.success(response.data.success, 'Success!', { timeout: 5000 });
                }).catch( error => {
                    this.ready = true;
                    if (error.response.data.errors) {
                        const errorType = Object.keys(error.response.data.errors)[0];
                        this.error = true;
                        this.errorType = errorType;
                        this.errorMessage = error.response.data.errors[errorType][0];
                    }
                    if (error.response.data.card_error) {
                        const errorType = 'card';
                        this.error = true;
                        this.errorType = errorType;
                        this.errorMessage = error.response.data.card_error;
                    }
                    if (error.response.data.customer_error) {
                        const errorType = 'customer';
                        this.error = true;
                        this.errorType = errorType;
                        this.errorMessage = error.response.data.customer_error;
                    }
                });
            } else if (result.error) {
                this.ready = true;
                this.error = true;
                this.errorType = 'card';
                this.errorMessage = result.error.message;
            }
        },
        resetForm () {
            this.card.clear();
            this.error = false;
            this.success = false;
            this.extraDetails.name = null;
            this.phone = null;
            this.email = null;
            this.address = null;
            this.city = null;
            this.state = null;
            this.zip = null;
            this.deliveryType = 'shipped';
            this.pickupLocation = null;
            this.token = null;
            this.errorMessage = null;
            forEach(this.sizes, (value, key) => {
                this.sizes[key] = 0;
            });
        },
        calculateTotal () {
            let total = 0;
            forEach(this.sizes, (value, key) => {
                total = total + this.prices[key] * value;
            });

            if (this.deliveryType === 'shipped') {
                total += 5;
            }

            return total;
        },
    },
}
</script>
