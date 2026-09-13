<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Check, ChevronDown, Globe2 } from '@lucide/vue';
import { useTranslation } from '@/composables/useTranslation';

const { t, locale, locales } = useTranslation();
</script>

<template>
    <details class="site-lang">
        <summary
            class="site-lang-trigger"
            :aria-label="t('site.a11y.choose_language')"
        >
            <Globe2 class="site-lang-globe" />
            <span>{{ locale.toUpperCase() }}</span>
            <ChevronDown class="site-lang-chevron" />
        </summary>

        <div class="site-lang-menu">
            <Link
                v-for="(label, code) in locales"
                :key="code"
                :href="`/locale/${code}`"
                preserve-scroll
                class="site-lang-link"
                :class="{ 'is-active': locale === code }"
                :aria-current="locale === code ? 'true' : undefined"
            >
                <span>{{ label }}</span>
                <Check v-if="locale === code" class="size-4" />
            </Link>
        </div>
    </details>
</template>
