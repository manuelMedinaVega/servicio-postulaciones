<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage, useForm } from '@inertiajs/vue3';
const page = usePage();
const user = page.props.auth.user;

const form = useForm({});
</script>

<template>
    <body class="bg-black text-white font-hanken-grotesk pb-20">
        <div class="px-10">
            <nav class="flex justify-between items-center py-4 border-b border-white/10">
                <div>
                    <a href="/">
                        <Link href="/">
                            <ApplicationLogo class="h-10 w-10 fill-current text-gray-500" />
                        </Link>
                    </a>
                </div>

                <div class="space-x-6 font-bold">
                    <a href="#">Jobs</a>
                    <a href="#">Careers</a>
                    <a href="#">Salaries</a>
                    <a href="#">Companies</a>
                </div>

                <div class="space-x-6 font-bold flex" v-if="user">
                    <Link href="#">Post a job</Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        Log out
                    </Link>
                </div>

                <div class="space-x-6 font-bold" v-else>
                    <Link href="/register">Sign Up</Link>
                    <Link href="/login">Log In</Link>
                </div>
            </nav>

            <main class="mt-10 max-w-[968px] mx-auto">
                <slot />
            </main>
        </div>
    </body>
</template>