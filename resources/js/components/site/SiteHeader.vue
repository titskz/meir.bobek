<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Menu } from '@lucide/vue';
import { computed, ref } from 'vue';
import SiteLanguageSwitcher from '@/components/site/SiteLanguageSwitcher.vue';
import SiteMobileNav from '@/components/site/SiteMobileNav.vue';
import { useTranslation } from '@/composables/useTranslation';
import { siteNavItems } from '@/config/siteNav';
import { siteAssets } from '@/lib/siteAssets';
import type { SiteSettings } from '@/types/site';

const props = defineProps<{ settings: SiteSettings }>();
const { t } = useTranslation();

const mobileOpen = ref(false);
const page = usePage();
const currentPath = computed(() => page.url.split('?')[0]);

const logoSrc = computed(() => props.settings.logo || siteAssets.logoIcon);

const isActive = (href: string) => {
    return (
        currentPath.value === href || currentPath.value.startsWith(`${href}/`)
    );
};
</script>

<template>
    <header class="site-header">
        <div class="site-container">
            <div class="site-header-inner">
                <Link
                    href="/"
                    class="site-header-logo"
                    :aria-label="t('site.a11y.home')"
                >
                    <span class="site-header-logo-mark">
                        <img :src="logoSrc" alt="" />
                    </span>
                    <span class="site-header-logo-copy">
                        <strong>{{ t('site.brand.name') }}</strong>
                        <small>{{ t('site.brand.subtitle') }}</small>
                    </span>
                </Link>

                <nav
                    class="site-header-nav"
                    :aria-label="t('site.a11y.main_navigation')"
                >
                    <Link
                        v-for="item in siteNavItems"
                        :key="item.href"
                        :href="item.href"
                        class="site-nav-link"
                        :class="{ 'is-active': isActive(item.href) }"
                        :aria-current="isActive(item.href) ? 'page' : undefined"
                    >
                        {{ t(item.labelKey) }}
                    </Link>
                </nav>

                <div
                    class="flex items-center justify-end gap-3 justify-self-end"
                >
                    <div class="site-header-actions">
                        <SiteLanguageSwitcher />
                    </div>
                    <button
                        type="button"
                        class="site-menu-trigger"
                        :aria-label="t('site.a11y.open_menu')"
                        aria-controls="site-mobile-menu"
                        :aria-expanded="mobileOpen"
                        @click="mobileOpen = true"
                    >
                        <Menu />
                    </button>
                </div>
            </div>
        </div>
    </header>

    <SiteMobileNav
        v-if="mobileOpen"
        :items="siteNavItems"
        :current-path="currentPath"
        @close="mobileOpen = false"
    />
</template>
