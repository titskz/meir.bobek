<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, ArrowRight, Home } from '@lucide/vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import { siteAssets } from '@/lib/siteAssets';
import type { SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings }>();

const { t } = useTranslation();

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
        return;
    }

    window.location.assign('/');
};
</script>

<template>
    <Head :title="t('site.error.404.eyebrow')" />

    <SiteLayout :settings="settings">
        <section class="site-not-found">
            <div class="site-container">
                <div class="site-not-found-panel">
                    <span class="site-not-found-orb site-not-found-orb--one" />
                    <span class="site-not-found-orb site-not-found-orb--two" />
                    <img
                        :src="siteAssets.star"
                        alt=""
                        class="site-not-found-star"
                    />
                    <img
                        :src="siteAssets.flowers"
                        alt=""
                        class="site-not-found-flowers"
                    />

                    <div class="site-not-found-copy">
                        <span class="site-not-found-eyebrow">
                            {{ t('site.error.404.eyebrow') }}
                        </span>
                        <strong class="site-not-found-code" aria-hidden="true">
                            404
                        </strong>
                        <h1 class="site-display">
                            {{ t('site.error.404.title') }}
                        </h1>
                        <p>{{ t('site.error.404.description') }}</p>

                        <div class="site-not-found-actions">
                            <Link href="/" class="site-btn-purple">
                                <Home />
                                {{ t('site.error.404.home') }}
                                <ArrowRight />
                            </Link>
                            <button
                                type="button"
                                class="site-btn-outline"
                                @click="goBack"
                            >
                                <ArrowLeft />
                                {{ t('site.error.404.back') }}
                            </button>
                        </div>
                    </div>

                    <img
                        :src="siteAssets.boy"
                        alt=""
                        class="site-not-found-child"
                    />
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
