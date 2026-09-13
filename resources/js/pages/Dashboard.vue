<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { FileText, Images, Settings, Users, UsersRound } from '@lucide/vue';
import { computed } from 'vue';
import { useTranslation } from '@/composables/useTranslation';
import { dashboard } from '@/routes';

const { t } = useTranslation();

const links = computed(() => [
    {
        title: t('admin.nav.pages'),
        href: '/admin/pages',
        icon: FileText,
        desc: t('admin.dashboard.pages_description'),
    },
    {
        title: t('admin.nav.groups'),
        href: '/admin/groups',
        icon: UsersRound,
        desc: t('admin.dashboard.groups_description'),
    },
    {
        title: t('admin.nav.gallery'),
        href: '/admin/gallery',
        icon: Images,
        desc: t('admin.dashboard.gallery_description'),
    },
    {
        title: t('admin.nav.team'),
        href: '/admin/team',
        icon: Users,
        desc: t('admin.dashboard.team_description'),
    },
    {
        title: t('admin.nav.settings'),
        href: '/admin/settings',
        icon: Settings,
        desc: t('admin.dashboard.settings_description'),
    },
]);
</script>

<template>
    <Head :title="t('nav.dashboard')" />
    <div class="flex flex-col gap-6 p-6">
        <div>
            <h1 class="text-2xl font-bold">
                {{ t('admin.dashboard.title') }}
            </h1>
            <p class="text-muted-foreground mt-1">
                {{ t('admin.dashboard.description') }}
            </p>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <Link
                v-for="item in links"
                :key="item.href"
                :href="item.href"
                class="bg-card rounded-xl border p-5 shadow-sm transition hover:border-[#E8913A] hover:shadow-md"
            >
                <component :is="item.icon" class="mb-3 size-8 text-[#E8913A]" />
                <div class="font-semibold">{{ item.title }}</div>
                <div class="text-muted-foreground mt-1 text-sm">
                    {{ item.desc }}
                </div>
            </Link>
        </div>
        <Link
            href="/"
            class="text-sm font-medium text-[#4A9B7F] hover:underline"
            >← {{ t('admin.nav.site') }}</Link
        >
    </div>
</template>
