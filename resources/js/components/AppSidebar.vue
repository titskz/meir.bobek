<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    FileText,
    Images,
    LayoutGrid,
    Settings,
    Users,
    UsersRound,
} from '@lucide/vue';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useTranslation } from '@/composables/useTranslation';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const { t } = useTranslation();

const mainNavItems = computed<NavItem[]>(() => [
    { title: t('nav.dashboard'), href: dashboard(), icon: LayoutGrid },
    { title: t('admin.nav.pages'), href: '/admin/pages', icon: FileText },
    { title: t('admin.nav.groups'), href: '/admin/groups', icon: UsersRound },
    { title: t('admin.nav.gallery'), href: '/admin/gallery', icon: Images },
    { title: t('admin.nav.team'), href: '/admin/team', icon: Users },
    { title: t('admin.nav.settings'), href: '/admin/settings', icon: Settings },
]);

const footerNavItems = computed<NavItem[]>(() => [
    { title: t('admin.nav.site'), href: '/', icon: LayoutGrid },
]);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>
        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
