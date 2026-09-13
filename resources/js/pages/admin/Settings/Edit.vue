<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import ImageUpload from '@/components/admin/ImageUpload.vue';
import RichTextEditor from '@/components/admin/RichTextEditor.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslation } from '@/composables/useTranslation';
import type { SiteSettings } from '@/types/site';

const props = defineProps<{
    settings: SiteSettings & {
        logo?: string;
        favicon?: string;
        hero_image?: string;
        manager_photo?: string;
    };
}>();
const { t } = useTranslation();

const managerBio = ref(props.settings.manager_bio ?? '');
const advantages = ref(props.settings.advantages ?? []);

const addAdvantage = () =>
    advantages.value.push({ title: '', description: '' });
const removeAdvantage = (i: number) => advantages.value.splice(i, 1);
</script>
<template>
    <Head :title="t('admin.settings.title')" />
    <div class="mx-auto max-w-4xl space-y-8 p-6">
        <h1 class="text-2xl font-bold">{{ t('admin.settings.title') }}</h1>
        <Form
            action="/admin/settings"
            method="put"
            enctype="multipart/form-data"
            class="space-y-8"
            v-slot="{ processing }"
        >
            <section class="space-y-4 rounded-lg border p-6">
                <h2 class="font-semibold">SEO</h2>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.site_name') }}</Label
                    ><Input
                        name="site_name"
                        :default-value="settings.site_name ?? ''"
                    />
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.keywords') }}</Label
                    ><Input
                        name="meta_keywords"
                        :default-value="settings.meta_keywords ?? ''"
                    />
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.description') }}</Label
                    ><textarea
                        name="meta_description"
                        class="border-input bg-background min-h-20 w-full rounded-md border px-3 py-2 text-sm"
                        :default-value="settings.meta_description ?? ''"
                    />
                </div>
                <ImageUpload
                    :label="t('admin.settings.logo')"
                    name="logo"
                    :current-url="
                        settings.logo ? `/storage/${settings.logo}` : null
                    "
                />
                <ImageUpload
                    label="Favicon"
                    name="favicon"
                    :current-url="
                        settings.favicon ? `/storage/${settings.favicon}` : null
                    "
                />
            </section>
            <section class="space-y-4 rounded-lg border p-6">
                <h2 class="font-semibold">
                    {{ t('admin.settings.contacts') }}
                </h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="grid gap-2">
                        <Label>{{ t('admin.settings.phone') }}</Label
                        ><Input
                            name="phone"
                            :default-value="settings.phone ?? ''"
                        />
                    </div>
                    <div class="grid gap-2">
                        <Label>Email</Label
                        ><Input
                            name="email"
                            :default-value="settings.email ?? ''"
                        />
                    </div>
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.address') }}</Label
                    ><Input
                        name="address"
                        :default-value="settings.address ?? ''"
                    />
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="grid gap-2">
                        <Label>WhatsApp</Label
                        ><Input
                            name="whatsapp"
                            :default-value="settings.whatsapp ?? ''"
                        />
                    </div>
                    <div class="grid gap-2">
                        <Label>Instagram URL</Label
                        ><Input
                            name="instagram"
                            :default-value="settings.instagram ?? ''"
                        />
                    </div>
                    <div class="grid gap-2">
                        <Label>Facebook</Label
                        ><Input
                            name="facebook"
                            :default-value="settings.facebook ?? ''"
                        />
                    </div>
                    <div class="grid gap-2">
                        <Label>TikTok</Label
                        ><Input
                            name="tiktok"
                            :default-value="settings.tiktok ?? ''"
                        />
                    </div>
                </div>
            </section>
            <section class="space-y-4 rounded-lg border p-6">
                <h2 class="font-semibold">{{ t('admin.settings.hero') }}</h2>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.heading') }}</Label
                    ><Input
                        name="hero_title"
                        :default-value="settings.hero_title ?? ''"
                    />
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.subheading') }}</Label
                    ><textarea
                        name="hero_subtitle"
                        class="border-input bg-background min-h-20 w-full rounded-md border px-3 py-2 text-sm"
                        :default-value="settings.hero_subtitle ?? ''"
                    />
                </div>
                <ImageUpload
                    :label="t('admin.settings.hero_photo')"
                    name="hero_image"
                    :current-url="
                        settings.hero_image
                            ? `/storage/${settings.hero_image}`
                            : null
                    "
                />
            </section>
            <section class="space-y-4 rounded-lg border p-6">
                <h2 class="font-semibold">{{ t('admin.settings.manager') }}</h2>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.full_name') }}</Label
                    ><Input
                        name="manager_name"
                        :default-value="settings.manager_name ?? ''"
                    />
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.position') }}</Label
                    ><Input
                        name="manager_position"
                        :default-value="settings.manager_position ?? ''"
                    />
                </div>
                <div class="grid gap-2">
                    <Label>{{ t('admin.settings.biography') }}</Label
                    ><input
                        type="hidden"
                        name="manager_bio"
                        :value="managerBio"
                    /><RichTextEditor v-model="managerBio" />
                </div>
                <ImageUpload
                    :label="t('admin.common.photo')"
                    name="manager_photo"
                    :current-url="
                        settings.manager_photo
                            ? `/storage/${settings.manager_photo}`
                            : null
                    "
                />
            </section>
            <section class="space-y-4 rounded-lg border p-6">
                <h2 class="font-semibold">
                    {{ t('admin.settings.documents') }}
                </h2>
                <div class="grid gap-2">
                    <Label>iframe URL</Label
                    ><Input
                        name="documents_iframe_url"
                        :default-value="settings.documents_iframe_url ?? ''"
                        placeholder="https://drive.google.com/embeddedfolderview?id=..."
                    />
                </div>
            </section>
            <section class="space-y-4 rounded-lg border p-6">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold">
                        {{ t('admin.settings.advantages') }}
                    </h2>
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        @click="addAdvantage"
                        >+ {{ t('admin.common.add') }}</Button
                    >
                </div>
                <div
                    v-for="(adv, i) in advantages"
                    :key="i"
                    class="grid gap-2 rounded border p-3"
                >
                    <Input
                        :name="`advantages[${i}][title]`"
                        v-model="adv.title"
                        :placeholder="t('admin.settings.advantage_title')"
                    />
                    <Input
                        :name="`advantages[${i}][description]`"
                        v-model="adv.description"
                        :placeholder="t('admin.settings.advantage_description')"
                    />
                    <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        @click="removeAdvantage(i)"
                        >{{ t('common.remove') }}</Button
                    >
                </div>
            </section>
            <div class="grid gap-2">
                <Label>{{ t('admin.settings.footer_text') }}</Label
                ><Input
                    name="footer_text"
                    :default-value="settings.footer_text ?? ''"
                />
            </div>
            <Button type="submit" :disabled="processing">{{
                t('common.save')
            }}</Button>
        </Form>
    </div>
</template>
