<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Globe2, Mail, MapPin, MessageCircle, Phone } from '@lucide/vue';
import PageHero from '@/components/site/PageHero.vue';
import { useTranslation } from '@/composables/useTranslation';
import SiteLayout from '@/layouts/SiteLayout.vue';
import type { SiteSettings } from '@/types/site';

defineProps<{ settings: SiteSettings }>();
const { t } = useTranslation();
</script>

<template>
    <Head :title="`${t('site.contacts.title')} — ${settings.site_name}`" />
    <SiteLayout :settings="settings">
        <PageHero
            :badge="t('site.contacts.badge')"
            :title="t('site.contacts.title')"
            :subtitle="t('site.contacts.subtitle')"
        />

        <section class="site-section">
            <div class="site-container">
                <div class="site-contacts-panel">
                    <span class="site-contacts-orb site-contacts-orb--one" />
                    <span class="site-contacts-orb site-contacts-orb--two" />

                    <div class="site-contacts-heading">
                        <span>{{ t('site.contacts.details') }}</span>
                        <h2 class="site-display">
                            {{ t('site.contacts.heading') }}
                        </h2>
                        <p>{{ t('site.contacts.description') }}</p>
                    </div>

                    <div class="site-contacts-grid">
                        <a
                            v-if="settings.phone"
                            :href="`tel:${settings.phone}`"
                            class="site-contact-item site-contact-item--phone"
                        >
                            <span class="site-contact-icon">
                                <Phone />
                            </span>
                            <span class="site-contact-copy">
                                <small>{{ t('site.contacts.phone') }}</small>
                                <strong>{{ settings.phone }}</strong>
                            </span>
                        </a>

                        <a
                            v-if="settings.email"
                            :href="`mailto:${settings.email}`"
                            class="site-contact-item site-contact-item--email"
                        >
                            <span class="site-contact-icon">
                                <Mail />
                            </span>
                            <span class="site-contact-copy">
                                <small>{{ t('site.contacts.email') }}</small>
                                <strong>{{ settings.email }}</strong>
                            </span>
                        </a>

                        <div
                            v-if="settings.address"
                            class="site-contact-item site-contact-item--address"
                        >
                            <span class="site-contact-icon">
                                <MapPin />
                            </span>
                            <span class="site-contact-copy">
                                <small>{{ t('site.contacts.address') }}</small>
                                <strong>{{ settings.address }}</strong>
                            </span>
                        </div>
                    </div>

                    <div
                        v-if="settings.whatsapp || settings.instagram"
                        class="site-contacts-socials"
                    >
                        <a
                            v-if="settings.whatsapp"
                            :href="`https://wa.me/${settings.whatsapp.replace(/\D/g, '')}`"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="site-btn-purple"
                        >
                            <MessageCircle class="size-5" />
                            WhatsApp
                        </a>
                        <a
                            v-if="settings.instagram"
                            :href="settings.instagram"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="site-btn-outline"
                        >
                            <Globe2 class="size-5" />
                            Instagram
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </SiteLayout>
</template>
