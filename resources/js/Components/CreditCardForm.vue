<template>
    <form>
        <div class="mb-4">
            <label for="cardNumber" class="block text-sm font-medium text-gray-700">Card Number</label>
            <input type="text" id="cardNumber"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label for="expirationMonth" class="block text-sm font-medium text-gray-700">Expiration Month</label>
                <input type="text" id="expirationMonth"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="expirationYear" class="block text-sm font-medium text-gray-700">Expiration Year</label>
                <input type="text" id="expirationYear" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                <input type="text" id="cvv"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>
        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-gray-700">Amount to Withdraw</label>
            <input type="text" id="amount"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="flex justify-center">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-200 disabled:opacity-25 transition">Submit</button>
        </div>
    </form>
</template>


