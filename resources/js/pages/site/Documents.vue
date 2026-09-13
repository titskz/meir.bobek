<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { FileText } from '@lucide/vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings; iframeUrl?: string | null }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${t('site.documents.badge')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.documents.badge')"
            :title="t('site.documents.title')"
            :subtitle="t('site.documents.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div v-if="iframeUrl" class="site-documents-frame">
                    <div class="site-documents-frame-head">
                        <span>
                            <FileText /> {{ t('site.documents.title') }}
                        </span>
                    </div>
                    <iframe
                        :src="iframeUrl"
                        :title="t('site.documents.frame_title')"
                        loading="lazy"
                    />
                </div>
                <div v-else class="site-documents-empty">
                    <div>
                        <FileText />
                    </div>
                    <h2>{{ t('site.documents.empty_title') }}</h2>
                    <p>{{ t('site.documents.empty_description') }}</p>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
