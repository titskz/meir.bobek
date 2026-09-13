<script setup lang="ts">
import { nextTick, onBeforeUnmount, onMounted, ref } from 'vue';
import SiteFooter from '@/components/site/SiteFooter.vue';
import SiteHeader from '@/components/site/SiteHeader.vue';
import { useTranslation } from '@/composables/useTranslation';
import type { SiteSettings } from '@/types/site';

defineProps<{
    settings: SiteSettings;
    hideFooter?: boolean;
}>();
const { t } = useTranslation();

let revealObserver: IntersectionObserver | null = null;
const siteRoot = ref<HTMLElement | null>(null);

onMounted(async () => {
    await nextTick();

    revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver?.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px -40px' },
    );

    siteRoot.value
        ?.querySelectorAll('main > section:not(:first-child)')
        .forEach((section) => {
            section.classList.add('site-reveal');
            revealObserver?.observe(section);
        });
});

onBeforeUnmount(() => revealObserver?.disconnect());
</script>

<template>
    <div
        ref="siteRoot"
        class="site site-paper min-h-dvh bg-[var(--site-cream)] text-[var(--site-ink)] antialiased"
    >
        <a href="#site-main-content" class="site-skip-link">
            {{ t('site.a11y.skip_to_content') }}
        </a>
        <SiteHeader :settings="settings" />
        <main id="site-main-content" tabindex="-1">
            <slot />
        </main>
        <SiteFooter v-if="!hideFooter" :settings="settings" />
    </div>
</template>
