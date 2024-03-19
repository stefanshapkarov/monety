<template>
    <div class="flex flex-col items-center justify-between align-middle">
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
        <form class="bg-white w-full max-w-md mx-auto px-6 py-8 shadow-md rounded-md">
            <div class="mb-4">
                <label for="cardNumber" class="block text-neutral-800 font-bold text-sm mb-2">Card number:</label>
                <input type="text" id="cardNumber" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" v-model="cardData.cardNumber" />
            </div>
            <div class="flex justify-between mb-4">
                <div class="w-1/2 mr-2">
                    <label for="expDate" class="block text-neutral-800 font-bold text-sm mb-2">Exp. date:</label>
                    <input type="text" id="expDate" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="5" placeholder="MM/YY" v-model="cardData.expDate" />
                </div>
                <div class="w-1/2 ml-2">
                    <label for="ccvNumber" class="block text-neutral-800 font-bold text-sm mb-2">CCV:</label>
                    <input type="text" id="ccvNumber" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" maxlength="3" placeholder="123" v-model="cardData.ccvNumber" />
                </div>
            </div>
            <div class="mb-4">
                <label for="cardName" class="block text-neutral-800 font-bold text-sm mb-2">Card holder:</label>
                <input type="text" id="cardName" class="block w-full h-10 px-4 py-2 rounded-md border border-slate-300 focus:outline-none focus:border-purple-600 focus:ring focus:ring-purple-200" placeholder="John Doe" v-model="cardData.cardName" />
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cardData: {
                cardNumber: '4256 4256 4256 4256',
                cardName: 'John Doe',
                expDate: '12/24',
                ccvNumber: '342'
            }
        };
    },
    methods: {
        flipCard() {
            const cardEl = document.querySelector('.credit-card');
            if (cardEl.classList.contains('rearIsVisible')) {
                cardEl.classList.remove('rearIsVisible');
            } else {
                cardEl.classList.add('rearIsVisible');
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
