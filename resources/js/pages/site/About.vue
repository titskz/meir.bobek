<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, ArrowRight, Quote, Sparkles } from '@lucide/vue';
import { computed, ref } from 'vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { CmsPage, SiteSettings, TeamMember } from '@/types/site';

const props = defineProps<{
    settings: SiteSettings;
    page: CmsPage;
    team: TeamMember[];
}>();
const { t, locale } = useTranslation();

const teamSlider = ref<HTMLElement | null>(null);
const managerBio = computed(() =>
    locale.value === 'kk' && props.settings.manager_bio
        ? props.settings.manager_bio
        : `<p>${t('site.home.manager.quote')}</p>`,
);

const scrollTeam = (direction: number) => {
    teamSlider.value?.scrollBy({
        left: direction * 360,
        behavior: 'smooth',
    });
};
</script>

<template>
    <Head :title="`${t('site.about.badge')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.about.badge')"
            :title="t('site.about.title')"
            :subtitle="t('site.about.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div class="site-about-story">
                    <div v-if="page.image_url" class="site-about-story-media">
                        <img :src="page.image_url" :alt="page.title" />
                        <span class="site-about-story-badge">
                            <Sparkles class="size-4" />
                            {{ t('site.about.title') }}
                        </span>
                    </div>
                    <div class="site-about-story-copy">
                        <span class="site-about-kicker">
                            {{ t('site.about.kindergarten') }}
                        </span>
                        <div class="site-about-prose" v-html="page.content" />
                    </div>
                </div>
            </div>
        </section>

        <section v-if="settings.manager_name" class="site-section">
            <div class="site-container">
                <div class="site-about-manager">
                    <span class="site-about-manager-orb" />
                    <div class="site-about-manager-photo">
                        <img
                            v-if="settings.manager_photo"
                            :src="settings.manager_photo"
                            :alt="settings.manager_name"
                        />
                    </div>

                    <div class="site-about-manager-copy">
                        <span class="site-about-kicker">
                            {{ t('site.about.manager') }}
                        </span>
                        <h2 class="site-display">
                            {{ settings.manager_name }}
                        </h2>
                        <p class="site-about-manager-position">
                            {{ settings.manager_position }}
                        </p>
                        <div class="site-about-manager-quote">
                            <Quote class="site-about-quote-icon" />
                            <div v-html="managerBio" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="team.length" class="site-section">
            <div class="site-container">
                <div class="site-about-team-heading">
                    <div>
                        <span class="site-about-kicker">
                            {{ t('site.about.team') }}
                        </span>
                        <h2 class="site-display">
                            {{ t('site.about.educators') }}
                        </h2>
                        <p>{{ t('site.about.team_description') }}</p>
                    </div>
                    <div class="site-about-team-controls">
                        <button
                            type="button"
                            :aria-label="t('site.about.previous')"
                            @click="scrollTeam(-1)"
                        >
                            <ArrowLeft />
                        </button>
                        <button
                            type="button"
                            :aria-label="t('site.about.next')"
                            @click="scrollTeam(1)"
                        >
                            <ArrowRight />
                        </button>
                    </div>
                </div>

                <div ref="teamSlider" class="site-about-team-slider">
                    <article
                        v-for="member in team"
                        :key="member.id"
                        class="site-about-team-card"
                    >
                        <img :src="member.image_url || ''" :alt="member.name" />
                        <div>
                            <h3>{{ member.name }}</h3>
                            <p>{{ member.position }}</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
