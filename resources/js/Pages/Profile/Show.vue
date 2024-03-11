<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">-->
<!--                Profile-->
<!--            </h2>-->
<!--        </template>-->

        <div>
            <div class="grid grid-cols-1 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="md:grid md:grid-cols-2 mb-10">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation" class="md:mr-8">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm  class="sm:mt-10 md:mt-0"/>
                </div>
                </div>

                <div class="md:grid md:grid-cols-2">
                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication" class="md:mr-8">
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="sm:mt-10 md:mt-0"
                    />
                </div>

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <DeleteUserForm class="sm:mt-10 md:mt-0" />
                </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
