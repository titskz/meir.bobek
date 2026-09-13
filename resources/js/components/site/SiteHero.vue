<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { computed } from 'vue';
import { useTranslation } from '@/composables/useTranslation';
import { siteAssets } from '@/lib/siteAssets';
import type { SiteSettings } from '@/types/site';

const props = defineProps<{ settings: SiteSettings }>();
const { t, locale } = useTranslation();

const heroBadge = computed(() =>
    locale.value === 'kk' && props.settings.hero_title
        ? props.settings.hero_title
        : t('site.hero.badge'),
);

const heroSubtitle = computed(() =>
    locale.value === 'kk' && props.settings.hero_subtitle
        ? props.settings.hero_subtitle
        : t('site.hero.subtitle'),
);
</script>

<template>
    <section class="site-hero">
        <div class="site-container">
            <div class="site-hero-grid">
                <div>
                    <div class="site-badge-row">
                        <div class="site-badge">
                            {{ heroBadge }}
                        </div>
                        <img
                            :src="siteAssets.purpleHeart"
                            alt=""
                            class="site-badge-heart"
                        />
                    </div>

                    <h1 class="site-display site-hero-title">
                        <span class="site-hero-line site-hero-line--navy">
                            {{ t('site.hero.title.happy') }}
                        </span>
                        <span class="site-hero-line site-hero-line--navy">
                            {{ t('site.hero.title.childhood') }}
                        </span>
                        <span class="site-hero-line site-hero-line--purple">
                            {{ t('site.hero.title.from_here') }}
                        </span>
                        <span class="site-hero-line site-hero-line--purple">
                            {{ t('site.hero.title.starts') }}
                        </span>
                    </h1>

                    <p class="site-hero-subtitle">
                        {{ heroSubtitle }}
                    </p>

                    <div class="site-hero-actions">
                        <Link href="/contacts" class="site-btn-purple">
                            {{ t('site.hero.enroll') }}
                            <ArrowRight class="size-[18px] stroke-[2.5]" />
                        </Link>
                        <Link href="/about" class="site-btn-outline">
                            {{ t('site.hero.about') }}
                        </Link>
                    </div>
                </div>

                <div class="site-hero-visual">
                    <img
                        :src="props.settings.hero_image || siteAssets.hero"
                        :alt="props.settings.site_name || t('site.hero.badge')"
                        class="site-hero-image"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
