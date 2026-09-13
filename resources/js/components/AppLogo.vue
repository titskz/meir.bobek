<script setup lang="ts">
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();
</script>

<template>
    <div
        class="flex size-11 shrink-0 items-center justify-center overflow-hidden rounded-[14px] border border-violet-100 bg-gradient-to-br from-white to-violet-50 shadow-[0_5px_14px_rgba(124,77,255,0.13)]"
    >
        <img
            src="/images/m-icon.png"
            alt=""
            class="size-8 rounded-[9px] object-cover"
        />
    </div>
    <div class="ml-2 grid min-w-0 flex-1 text-left">
        <span
            class="truncate text-[15px] leading-[1.1] font-black tracking-[0.04em] text-[#2d3561]"
        >
            {{ t('site.brand.name') }}
        </span>
        <span
            class="mt-1 truncate text-[11px] leading-none font-semibold text-[#7c5cff]"
        >
            {{ t('site.brand.subtitle') }}
        </span>
    </div>
</template>
