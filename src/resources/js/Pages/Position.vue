<script setup>

import HomeLayout from '@/Layouts/HomeLayout.vue';
import {Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    position: Object,
    hasApplied: Boolean
});

const user = usePage().props.auth.user;
const isApplying = ref(false);
const applied = ref(false);
const form = useForm({
    position_id: null
})

const submit = () => {
    isApplying.value = true;
    //form.position_id = props.position.id;
    form.position_id = 2

    form.post(route('positions.apply'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            applied.value = true;
        },
        onFinish: () => {
            isApplying.value = false;
        }
    });
}

</script>

<template>
    <HomeLayout>
        <Head :title="position.title" />

        <div class="space-y-10">

            <section class="flex flex-col items-center text-center pt-6">
                <img
                    :src="position.company.logo"
                    :alt="`Logo of ${position.company.name}`"
                    class="mt-2 rounded-xl"
                    width="90"
                />
                <h1 class="font-bold text-4xl">{{ position.title }}</h1>
            </section>

            <section class="pt-10">
                <div class="inline-flex items-center gap-x-2">
                    <span class="w-2 h-2 bg-white inline-block"></span>
                    <h3 class="font-bold text-lg">Job Details</h3>
                </div>

                <div class="mt-6">
                    <p class="text-sm">{{ position.description }}</p>
                    <p class="mt-2 text-sm"><strong>Location:</strong> {{ position.location }}</p>
                    <p class="mt-2 text-sm"><strong>Company:</strong> {{ position.company.name }}</p>
                    
                </div>
                
                <div v-if="hasApplied">
                    <button
                        type="submit"
                        disabled
                        class="inline-flex justify-center items-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 opacity-50 cursor-not-allowed"
                    >
                        <span>Applied</span>
                    </button>
                </div>
                <div class="mt-6 space-y-4" v-else>
                    <form @submit.prevent="submit">

                        <div v-if="form.errors.position_id" class="text-red-500 text-sm mb-2">
                            {{ form.errors.position_id }}
                        </div>

                        <button
                            type="submit"
                            :disabled="isApplying || applied"
                            class="inline-flex justify-center items-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            :class="{ 'opacity-50 cursor-not-allowed': isApplying || applied }"
                        >
                            <span v-if="isApplying">Applying...</span>
                            <span v-else-if="applied">Applied</span>
                            <span v-else>Apply Now</span>
                        </button>
                    </form>
                </div>
            </section>

        </div>

    </HomeLayout>
    
</template>