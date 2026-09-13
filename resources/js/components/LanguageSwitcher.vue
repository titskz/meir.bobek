<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { useTranslation } from '@/composables/useTranslation';

const { t, locale, locales } = useTranslation();
</script>

<template>
    <div
        class="bg-background inline-flex items-center gap-0.5 rounded-lg border p-0.5 text-sm shadow-sm"
        role="group"
        :aria-label="t('site.a11y.choose_language')"
    >
        <Link
            v-for="(label, code) in locales"
            :key="code"
            :href="`/locale/${code}`"
            preserve-scroll
            class="rounded-md px-2.5 py-1 font-medium transition-colors"
            :class="
                locale === code
                    ? 'bg-primary text-primary-foreground shadow-sm'
                    : 'text-muted-foreground hover:bg-muted hover:text-foreground'
            "
            :aria-current="locale === code ? 'true' : undefined"
        >
            {{ label }}
        </Link>
    </div>
</template>
