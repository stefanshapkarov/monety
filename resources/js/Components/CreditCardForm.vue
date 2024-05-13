<template>
    <div class="flex items-center justify-between align-middle bg-purple-50 shadow-xl rounded-md pl-5 mb-5">
        <div class="w-full h-56 mb-8" style="perspective: 1000px">
            <div class="credit-card relative cursor-pointer transition-transform duration-500" style="transform-style: preserve-3d" @click="flipCard">
                <div class="w-full m-auto rounded-xl shadow-2xl absolute" style="backface-visibility: hidden">
                    <img src="https://i.ibb.co/swnZ5b1/Front-Side-Card.jpg" class="relative object-cover w-full h-full rounded-xl" />
                    <div class="w-full px-8 absolute top-8 text-white">
                        <div class="pt-1">
                            <p class="font-light">Card Number</p>
                            <p class="font-medium tracking-more-wider h-6">{{ cardData.cardNumber }}</p>
                        </div>
                        <div class="pt-6 flex justify-between">
                            <div>
                                <p class="font-light">Name</p>
                                <p class="font-medium tracking-widest h-6">{{ cardData.cardName }}</p>
                            </div>
                            <div>
                                <p class="font-light">Expiry</p>
                                <p class="font-medium tracking-wider h-6 w-14">{{ cardData.expDate }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full m-auto rounded-xl shadow-2xl absolute" style="backface-visibility: hidden; transform: rotateY(180deg)">
                    <img src="https://i.ibb.co/Fn11jBc/Rear-Side-Card.jpg" class="relative object-cover w-full h-full rounded-xl" />
                    <div class="w-full absolute top-8">
                        <div class="px-8 mt-12">
                            <p class="text-black flex items-center pl-4 pr-2 w-14 ml-auto">{{ cardData.ccvNumber }}</p>
                            <p class="text-white font-light flex justify-end text-sm mt-2">security code</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit" class=" w-full max-w-md mx-auto px-6 py-8 ">
            <div class="mb-4">
                <label for="cardNumber" class="block text-purple-600 font-bold text-base mb-2">Card number:</label>
                <input @focus="flipCard('front')" @input="flipCard('front')" @click="flipCard('front')" type="text" id="cardNumber" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" v-model="cardData.cardNumber" />
            </div>
            <div class="flex justify-between mb-4">
                <div class="w-1/2 mr-2">
                    <label for="expDate" class="block text-purple-600 font-bold text-base mb-2">Exp. date:</label>
                    <input @focus="flipCard('front')" @input="flipCard('front')" @click="flipCard('front')" type="text" id="expDate" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="5" placeholder="MM/YY" v-model="cardData.expDate" />
                </div>
                <div class="w-1/2 ml-2">
                    <label for="ccvNumber" class="block text-purple-600 font-bold text-base mb-2">CCV:</label>
                    <input @focus="flipCard('rear')" @input="flipCard('rear')" @click="flipCard('rear')" type="text" id="ccvNumber" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="3" placeholder="123" v-model="cardData.ccvNumber" />
                </div>
            </div>
            <div class="mb-4">
                <label for="cardName" class="block text-purple-600 font-bold text-base mb-2">Card holder:</label>
                <input @focus="flipCard('front')" @input="flipCard('front')" @click="flipCard('front')" type="text" id="cardName" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" placeholder="John Doe" v-model="cardData.cardName" />
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-purple-600 font-bold text-base mb-2">Amount:</label>
                <input type="number" step="any" id="amount" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" :placeholder="'Minimum: ' + minimumAmount + ' ' + props.currency" v-model="form.amount" />
                <p v-if="form.amount < minimumAmounts[$props.currency] && form.amount !== ''" class="text-red-500 text-sm mt-1">Amount must be at least {{ minimumAmount }} {{ props.currency }}</p>
            </div>
            <button :disabled="form.amount < minimumAmounts[$props.currency]" type="submit" class="float-right bg-purple-600 py-2 px-4 text-purple-50 font-semibold hover:bg-purple-300 hover:text-purple-600 hover:ring hover:ring-purple-600 rounded-md capitalize">
                {{ $props.path }}
            </button>
        </form>
    </div>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3';
import {defineProps, ref, watch} from "vue";

const props = defineProps(['closeModal', 'currency', 'path']);

const form = useForm({
    amount: ''
});

const minimumAmounts = {
    USD: 5,
    EUR: 5,
    MKD: 300,
};

const minimumAmount = ref(minimumAmounts[props.currency] || 0);

watch(() => props.currency, (newValue) => {
    minimumAmount.value = minimumAmounts[newValue] || 0;
});
const submit = async (e) => {
    e.preventDefault();
    form.post('/' + props.path, {
        onSuccess: () => {
            props.closeModal();
        },
    });
};
</script>

<script>
export default {
    data() {
        return {
            cardData: {
                cardNumber: '',
                cardName: '',
                expDate: '',
                ccvNumber: ''
            }
        };
    },
    methods: {
        flipCard(side) {
            const cardEl = document.querySelector('.credit-card');
            if (side === 'rear') {
                cardEl.classList.add('rearIsVisible');
            } else if (side === 'front') {
                cardEl.classList.remove('rearIsVisible');
            }
        }
    }
};
</script>

<style scoped>
.credit-card {
    width: 300px;
    height: 200px;
}

.credit-card .absolute {
    width: 100%;
    height: 100%;
}

.credit-card.rearIsVisible {
    transform: rotateY(-180deg);
}
</style>
