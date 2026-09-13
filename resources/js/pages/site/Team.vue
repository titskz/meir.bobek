<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { SiteSettings, TeamMember } from '@/types/site';

defineProps<{ settings: SiteSettings; members: TeamMember[] }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${t('site.team.badge')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.team.badge')"
            :title="t('site.team.title')"
            :subtitle="t('site.team.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div class="site-team-grid">
                    <article
                        v-for="member in members"
                        :key="member.id"
                        class="site-team-card"
                    >
                        <div class="site-team-card-photo">
                            <img
                                v-if="member.image_url"
                                :src="member.image_url || ''"
                                :alt="member.name"
                                loading="lazy"
                                decoding="async"
                            />
                            <span v-else>{{ member.name.charAt(0) }}</span>
                        </div>
                        <div class="site-team-card-copy">
                            <h2 class="site-display">{{ member.name }}</h2>
                            <p>{{ member.position }}</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
