<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import LanguageSwitcher from '@/components/LanguageSwitcher.vue';
import { useTranslation } from '@/composables/useTranslation';
import { dashboard, login } from '@/routes';

const { t } = useTranslation();
</script>

<template>
    <Head :title="t('welcome.login')">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <header
            class="mb-6 flex w-full max-w-[335px] items-center justify-between gap-4 lg:max-w-4xl"
        >
            <LanguageSwitcher />
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    {{ t('welcome.dashboard') }}
                </Link>
                <Link
                    v-else
                    :href="login()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    {{ t('welcome.login') }}
                </Link>
            </nav>
        </header>
        <div
            class="flex w-full flex-1 items-center justify-center opacity-100 transition-opacity duration-750 starting:opacity-0"
        >
            <main class="text-center">
                <h1 class="text-2xl font-medium">{{ $page.props.name }}</h1>
            </main>
        </div>
    </div>
</template>
