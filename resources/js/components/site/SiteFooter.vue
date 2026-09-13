<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Globe, Mail, MapPin, Phone } from '@lucide/vue';
import { siteNavItems } from '@/config/siteNav';
import { useTranslation } from '@/composables/useTranslation';
import { siteAssets } from '@/lib/siteAssets';
import type { SiteSettings } from '@/types/site';

const props = defineProps<{ settings: SiteSettings }>();
const { t } = useTranslation();

const year = new Date().getFullYear();
</script>

<template>
    <footer class="border-t border-purple-100 bg-white">
        <div class="site-container grid gap-10 py-12 md:grid-cols-3">
            <div>
                <img
                    :src="props.settings.logo || siteAssets.logo"
                    :alt="t('site.brand.name')"
                    class="h-10 w-auto"
                />
                <p class="mt-4 text-sm font-normal text-[var(--site-muted)]">
                    {{ settings.footer_text }}
                </p>
            </div>

            <nav
                class="space-y-2 text-sm font-semibold"
                :aria-label="t('site.a11y.footer_navigation')"
            >
                <Link
                    v-for="item in siteNavItems"
                    :key="item.href"
                    :href="item.href"
                    class="block text-[var(--site-muted)] hover:text-[var(--site-purple)]"
                >
                    {{ t(item.labelKey) }}
                </Link>
            </nav>

            <div class="space-y-3 text-sm font-normal text-[var(--site-muted)]">
                <a
                    v-if="settings.phone"
                    :href="`tel:${settings.phone}`"
                    class="flex items-center gap-2 hover:text-[var(--site-purple)]"
                >
                    <Phone class="size-4 text-[var(--site-purple)]" />
                    {{ settings.phone }}
                </a>
                <a
                    v-if="settings.email"
                    :href="`mailto:${settings.email}`"
                    class="flex items-center gap-2 hover:text-[var(--site-purple)]"
                >
                    <Mail class="size-4 text-[var(--site-purple)]" />
                    {{ settings.email }}
                </a>
                <div v-if="settings.address" class="flex items-start gap-2">
                    <MapPin
                        class="mt-0.5 size-4 shrink-0 text-[var(--site-purple)]"
                    />
                    {{ settings.address }}
                </div>
                <a
                    v-if="settings.instagram"
                    :href="settings.instagram"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 pt-1 hover:text-[var(--site-purple)]"
                >
                    <Globe class="size-4" /> Instagram
                </a>
            </div>
        </div>

        <div
            class="border-t border-purple-50 py-4 text-center text-xs text-[var(--site-muted)]"
        >
            © {{ year }} {{ settings.site_name }}
        </div>
    </footer>
</template>
