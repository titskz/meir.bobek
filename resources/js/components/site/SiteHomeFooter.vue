<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { useTranslation } from '@/composables/useTranslation';
import { siteAssets } from '@/lib/siteAssets';

const { t } = useTranslation();
</script>

<template>
    <section class="site-footer-cta">
        <div class="site-container">
            <div class="site-footer-banner">
                <img
                    :src="siteAssets.grass"
                    alt=""
                    class="site-footer-banner-grass site-footer-banner-grass--left"
                />
                <img
                    :src="siteAssets.grass"
                    alt=""
                    class="site-footer-banner-grass site-footer-banner-grass--right"
                />

                <img
                    :src="siteAssets.boy"
                    alt=""
                    class="site-footer-banner-child site-footer-banner-boy"
                />

                <div class="site-footer-banner-copy">
                    <h2 class="site-display">
                        {{ t('site.footer.cta.title_line_1') }}<br />
                        {{ t('site.footer.cta.title_line_2') }}
                    </h2>
                    <p>{{ t('site.footer.cta.subtitle') }}</p>
                </div>

                <Link
                    href="/contacts"
                    class="site-btn-purple site-footer-banner-button"
                >
                    {{ t('site.footer.cta.button') }}
                    <ArrowRight class="size-[18px] stroke-[2.5]" />
                </Link>

                <img
                    :src="siteAssets.girl"
                    alt=""
                    class="site-footer-banner-child site-footer-banner-girl"
                />
            </div>
        </div>
    </section>
</template>
