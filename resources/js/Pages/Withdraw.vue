<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import VCreditCard from 'v-credit-card';
// import 'v-credit-card/dist/VCreditCard.css';
import vuePaycard from "vue-paycard";
</script>

<template>
    <AppLayout title="Withdraw">
        <div class="flex flex-col">
            <h1 class="font-semibold text-4xl text-gray-800 dark:text-gray-200 leading-tight">
                Withdraw Money
            </h1><br>
<!--            <VCreditCard @change="creditInfoChanged" @creditChange="cardChanged"/>-->
            <h1>Credit card but the card isnt working :(</h1>
            <h1 class="text-4xl">After 3 hours: Still doesnt work :(</h1>
            <vuePaycard :valueFields="valueFields" />
            <h1>TODO: Custom credit card</h1>
        </div>
        <button class="bg-white text-emerald-400 border-2 border-emerald-400 py-2 px-4 rounded-md transition duration-300 ease-in-out hover:bg-transparent hover:text-emerald-400 focus:outline-none focus:border-emerald-400 focus:ring-emerald-400">
            Click Me
        </button>
    </AppLayout>
</template>

<script>
import { ref } from 'vue';

export default {
    data: () => ({
        valueFields: {
            cardName: 'Mite',
            cardNumber: '1111 1111 1111 1111',
            cardMonth: '09',
            cardYear: '2025',
            cardCvv: '111'
        }
    })
}

//     setup() {
//         const name = ref('');
//         const cardNumber = ref('');
//         const expiration = ref('');
//         const security = ref('');
//         const cardName = ref(null);
//
//         const creditInfoChanged = (values) => {
//             for (const key in values) {
//                 if (Object.hasOwnProperty.call(values, key)) {
//                     switch (key) {
//                         case 'name':
//                             name.value = values[key];
//                             break;
//                         case 'cardNumber':
//                             cardNumber.value = values[key];
//                             break;
//                         case 'expiration':
//                             expiration.value = values[key];
//                             break;
//                         case 'security':
//                             security.value = values[key];
//                             break;
//                         default:
//                             break;
//                     }
//                 }
//             }
//         };
//
//         const cardChanged = (name) => {
//             cardName.value = name;
//         };
//
//         return {
//             name,
//             cardNumber,
//             expiration,
//             security,
//             cardName,
//             creditInfoChanged,
//             cardChanged
//         };
//     },
//     components: {
//         VCreditCard
//     }
// }

</script>
