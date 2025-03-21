<script setup>

import HomeLayout from '@/Layouts/HomeLayout.vue';
import {Head, Link} from '@inertiajs/vue3'

defineProps({
    positions: Array
})

</script>

<template>
    <HomeLayout>
        <Head title="Home" />

        <div class="space-y-10">

            <section class="text-center pt-6">
                <h1 class="font-bold text-4xl">Open Positions</h1>

                <form action="/search" class="mt-6">
                    <input type="text"
                        class = "rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full"
                        name="q" placeholder="Web Developer..." />
                </form>
            </section>

            <section class="pt-10">
                <div class="inline-flex items-center gap-x-2">
                    <span class="w-2 h-2 bg-white inline-block"></span>
                    <h3 class="font-bold text-lg">
                        Recent Jobs
                    </h3>
                </div>
                
                <div class="mt-6 space-y-6">
                    <div 
                        v-for="position in positions"
                        :key="position.id"
                        class="flex gap-x-6 p-4 bg-red-500 rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300"
                    >
                        
                        <div>
                            <img :src="position.company.logo" 
                            :alt="`Logo of ${position.company.name}`" 
                            class="rounded-xl" 
                            width="90">
                        </div>

                        <Link :href="position.details_url">
                            <div class="flex-1 flex flex-col">
                                <a href="#" class="self-start text-sm text-gray-400">
                                    Company: {{ position.company.name }}
                                </a>
                                <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800 transition-colors duration-300">
                                    Position: {{ position.title }}
                                </h3>
                                <p class="text-sm text-gray-400 mt-auto">Location: {{ position.location }}</p>
                            </div>
                        </Link>

                    </div>
                    
                </div>
                
            </section>
        </div>

    </HomeLayout>
    
</template>