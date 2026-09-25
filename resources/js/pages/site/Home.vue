<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowRight } from '@lucide/vue';
import { computed } from 'vue';
import SiteHero from '@/components/site/SiteHero.vue';
import SiteHomeFooter from '@/components/site/SiteHomeFooter.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import { siteAssets } from '@/lib/siteAssets';
import type {
    CmsGroup,
    CmsPage,
    GalleryItem,
    SiteSettings,
    TeamMember,
} from '@/types/site';

const props = defineProps<{
    settings: SiteSettings;
    aboutPage?: CmsPage | null;
    team: TeamMember[];
    groups: CmsGroup[];
    gallery: GalleryItem[];
}>();
const { t, locale } = useTranslation();

const defaultFeatures = computed(() => [
    {
        icon: siteAssets.feature1,
        title: t('site.home.feature.play.title'),
        description: t('site.home.feature.play.description'),
        bg: 'bg-[var(--site-card-yellow)]',
    },
    {
        icon: siteAssets.feature2,
        title: t('site.home.feature.creativity.title'),
        description: t('site.home.feature.creativity.description'),
        bg: 'bg-[var(--site-card-mint)]',
    },
    {
        icon: siteAssets.feature3,
        title: t('site.home.feature.care.title'),
        description: t('site.home.feature.care.description'),
        bg: 'bg-[var(--site-card-pink)]',
    },
]);

const features = computed(() =>
    defaultFeatures.value.map((feature, index) => ({
        ...feature,
        ...(locale.value === 'kk' ? props.settings.advantages?.[index] : null),
    })),
);

const managerBio = computed(() =>
    locale.value === 'kk' && props.settings.manager_bio
        ? props.settings.manager_bio
        : `<p>${t('site.home.manager.quote')}</p>`,
);

const teacherCardBgs = [
    'bg-[var(--site-card-mint)]',
    'bg-[var(--site-card-pink)]',
    'bg-[var(--site-card-yellow)]',
];
</script>

<template>
    <Head>
        <title>{{ settings.site_name }}</title>
        <meta name="description" :content="settings.meta_description || ''" />
        <meta name="keywords" :content="settings.meta_keywords || ''" />
    </Head>

    <SiteLayout :settings="settings">
        <SiteHero :settings="settings" />

        <!-- Features -->
        <section class="site-section site-section--features">
            <div class="site-container">
                <div class="site-features-grid">
                    <article
                        v-for="feature in features"
                        :key="feature.title"
                        class="site-feature-card"
                        :class="feature.bg"
                    >
                        <img :src="feature.icon" alt="" />
                        <h3>{{ feature.title }}</h3>
                        <p>{{ feature.description }}</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Manager -->
        <section v-if="settings.manager_name" class="site-section">
            <div class="site-container">
                <div class="site-manager-block">
                    <img
                        :src="siteAssets.greenHeart"
                        alt=""
                        class="absolute bottom-6 left-5 hidden size-32 object-contain lg:block"
                    />
                    <img
                        :src="siteAssets.flowers"
                        alt=""
                        class="absolute right-5 bottom-5 hidden h-auto w-[180px] max-w-none lg:block"
                    />

                    <div class="site-manager-grid">
                        <div class="site-manager-photo">
                            <img
                                v-if="settings.manager_photo"
                                :src="settings.manager_photo"
                                :alt="settings.manager_name"
                            />
                        </div>
                        <div class="site-manager-copy">
                            <h3 class="site-display site-manager-name">
                                {{ settings.manager_name }}
                            </h3>
                            <p class="site-manager-position">
                                {{ settings.manager_position }}
                            </p>
                            <div class="site-quote">
                                <div
                                    class="site-quote-content"
                                    v-html="managerBio"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Teachers -->
        <section v-if="team.length" class="site-section">
            <div class="site-container">
                <div class="mb-10 text-center">
                    <div class="flex items-center justify-center gap-3">
                        <h2
                            class="site-display site-section-title site-section-title--dark"
                        >
                            {{ t('site.home.team.badge') }}
                        </h2>
                        <img
                            :src="siteAssets.purpleHeart"
                            alt=""
                            class="size-8"
                        />
                    </div>
                    <p class="site-section-subtitle">
                        {{ t('site.home.team.title') }}
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <article
                        v-for="(member, i) in team.slice(0, 3)"
                        :key="member.id"
                        class="site-teacher-card"
                        :class="teacherCardBgs[i % 3]"
                    >
                        <div class="site-teacher-photo">
                            <img
                                :src="member.image_url || ''"
                                :alt="member.name"
                            />
                            <img :src="siteAssets.purpleHeart" alt="" />
                        </div>
                        <h3>{{ member.name }}</h3>
                        <p>{{ member.position }}</p>
                    </article>
                </div>

                <div v-if="team.length > 3" class="mt-10 text-center">
                    <Link href="/team" class="site-btn-outline">
                        {{ t('site.home.team.all') }}
                        <ArrowRight class="size-[18px] stroke-[2.5]" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- Groups -->
        <section v-if="groups.length" class="site-section">
            <div class="site-container">
                <div class="relative mb-10 text-center lg:mb-12">
                    <div
                        class="flex flex-wrap items-center justify-center gap-3"
                    >
                        <h2
                            class="site-display site-section-title site-section-title--dark"
                        >
                            {{ t('site.home.groups.badge') }}
                        </h2>
                        <img
                            :src="siteAssets.purpleHeart"
                            alt=""
                            class="size-8"
                        />
                    </div>
                    <p class="site-section-subtitle mx-auto max-w-xl">
                        {{ t('site.home.groups.title') }}
                    </p>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <Link
                        v-for="group in groups.slice(0, 2)"
                        :key="group.id"
                        :href="`/groups/${group.slug}`"
                        class="site-group-card"
                    >
                        <img :src="group.image_url || ''" :alt="group.title" />
                        <div class="site-group-card-body">
                            <h3>{{ group.title }}</h3>
                            <div
                                class="site-group-card-content"
                                v-html="group.content"
                            />
                        </div>
                    </Link>
                </div>

                <div class="mt-10 text-center">
                    <Link href="/groups" class="site-btn-outline">
                        {{ t('site.home.groups.all') }}
                        <ArrowRight class="size-[18px] stroke-[2.5]" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- Gallery -->
        <section v-if="gallery.length" class="site-section">
            <div class="site-container">
                <div class="relative mb-10 text-center lg:mb-12">
                    <div
                        class="flex flex-wrap items-center justify-center gap-3"
                    >
                        <h2
                            class="site-display site-section-title site-section-title--dark"
                        >
                            {{ t('site.home.gallery.badge') }}
                        </h2>
                        <img
                            :src="siteAssets.purpleHeart"
                            alt=""
                            class="size-8"
                        />
                    </div>
                    <p class="site-section-subtitle mx-auto max-w-xl">
                        {{ t('site.home.gallery.title') }}
                    </p>
                </div>

                <div class="site-gallery-masonry">
                    <figure
                        v-for="item in gallery.slice(0, 8)"
                        :key="item.id"
                        class="site-gallery-masonry-item"
                    >
                        <img :src="item.image_url || ''" :alt="item.title" />
                        <figcaption>{{ item.title }}</figcaption>
                    </figure>
                </div>

                <div v-if="gallery.length > 8" class="mt-10 text-center">
                    <Link href="/gallery" class="site-btn-outline">
                        {{ t('site.home.gallery.all') }}
                        <ArrowRight class="size-[18px] stroke-[2.5]" />
                    </Link>
                </div>
            </div>
        </section>

        <SiteHomeFooter />
    </SiteLayout>
</template>
