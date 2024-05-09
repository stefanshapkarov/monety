<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormSection from "@/Components/FormSection.vue";
import ActionMessage from "@/Components/ActionMessage.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    currency: props.user.account.currency,
});

const updateAccountCurrency = () => {
    form.patch(route('account.updateCurrency'), {
        onSuccess: () => {
            form.reset('currency');
        }
    });
};

</script>

<template>
    <FormSection @submitted="updateAccountCurrency">
        <template #title>
            Update Account Currency
        </template>

        <template #description>
            Update the currency of your account.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="currency" value="Currency" />
                <select id="currency" v-model="form.currency" class="mt-1 block w-full">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="MKD">MKD</option>
                </select>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
