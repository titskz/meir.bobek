<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { X } from '@lucide/vue';
import { nextTick, onBeforeUnmount, onMounted, ref } from 'vue';
import SiteLanguageSwitcher from '@/components/site/SiteLanguageSwitcher.vue';
import { useTranslation } from '@/composables/useTranslation';
import type { SiteNavItem } from '@/config/siteNav';

const props = defineProps<{
    items: SiteNavItem[];
    currentPath: string;
}>();

const emit = defineEmits<{ close: [] }>();
const { t } = useTranslation();
const panel = ref<HTMLElement | null>(null);
let previousOverflow = '';

const isActive = (href: string) =>
    props.currentPath === href || props.currentPath.startsWith(`${href}/`);

const onKeydown = (event: KeyboardEvent) => {
    if (event.key === 'Escape') {
        emit('close');
        return;
    }

    if (event.key !== 'Tab' || !panel.value) {
        return;
    }

    const focusable = Array.from(
        panel.value.querySelectorAll<HTMLElement>(
            'a[href], button:not([disabled]), summary, [tabindex]:not([tabindex="-1"])',
        ),
    );

    if (!focusable.length) {
        return;
    }

    const first = focusable[0];
    const last = focusable.at(-1);

    if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last?.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
    }
};

onMounted(async () => {
    previousOverflow = document.body.style.overflow;
    document.body.style.overflow = 'hidden';
    document.addEventListener('keydown', onKeydown);

    await nextTick();
    panel.value?.querySelector<HTMLElement>('button, a[href]')?.focus();
});

onBeforeUnmount(() => {
    document.body.style.overflow = previousOverflow;
    document.removeEventListener('keydown', onKeydown);
});
</script>

<template>
    <div
        id="site-mobile-menu"
        class="site-mobile-nav"
        role="dialog"
        aria-modal="true"
        :aria-label="t('site.a11y.mobile_menu')"
    >
        <button
            type="button"
            class="site-mobile-nav-backdrop"
            :aria-label="t('site.a11y.close_menu')"
            @click="emit('close')"
        />

        <aside ref="panel" class="site-mobile-nav-panel">
            <div class="site-mobile-nav-head">
                <div>
                    <strong>{{ t('site.brand.name') }}</strong>
                    <span>{{ t('site.brand.subtitle') }}</span>
                </div>
                <button
                    type="button"
                    class="site-mobile-nav-close"
                    :aria-label="t('site.a11y.close_menu')"
                    @click="emit('close')"
                >
                    <X />
                </button>
            </div>

            <nav :aria-label="t('site.a11y.mobile_navigation')">
                <Link
                    v-for="(item, index) in items"
                    :key="item.href"
                    :href="item.href"
                    class="site-mobile-nav-link"
                    :class="{ 'is-active': isActive(item.href) }"
                    :aria-current="isActive(item.href) ? 'page' : undefined"
                    @click="emit('close')"
                >
                    <span>0{{ index + 1 }}</span>
                    {{ t(item.labelKey) }}
                </Link>
            </nav>

            <div class="site-mobile-nav-footer">
                <span>{{ t('site.mobile.choose_language') }}</span>
                <SiteLanguageSwitcher />
            </div>
        </aside>
    </div>
</template>
