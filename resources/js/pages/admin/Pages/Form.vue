<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import ImageUpload from '@/components/admin/ImageUpload.vue';
import RichTextEditor from '@/components/admin/RichTextEditor.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslation } from '@/composables/useTranslation';
import type { CmsPage } from '@/types/site';

const props = defineProps<{ page: CmsPage | null }>();
const { t } = useTranslation();
const content = ref(props.page?.content ?? '');
const isPublished = ref(props.page?.is_published ?? true);
const isEdit = !!props.page;
</script>

<template>
    <Head :title="isEdit ? t('admin.pages.edit') : t('admin.pages.new')" />
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <h1 class="text-2xl font-bold">
            {{ isEdit ? t('admin.pages.edit') : t('admin.pages.new') }}
        </h1>
        <Form
            :action="isEdit ? `/admin/pages/${page!.id}` : '/admin/pages'"
            :method="isEdit ? 'put' : 'post'"
            enctype="multipart/form-data"
            class="space-y-4"
            v-slot="{ processing }"
        >
            <div class="grid gap-2">
                <Label>{{ t('admin.common.title') }}</Label
                ><Input name="title" :default-value="page?.title" required />
            </div>
            <div class="grid gap-2">
                <Label>{{ t('admin.common.url') }}</Label
                ><Input
                    name="slug"
                    :default-value="page?.slug"
                    placeholder="about"
                />
            </div>
            <div class="grid gap-2">
                <Label>{{ t('admin.common.content') }}</Label
                ><input
                    type="hidden"
                    name="content"
                    :value="content"
                /><RichTextEditor v-model="content" />
            </div>
            <ImageUpload
                name="image"
                :label="t('admin.common.photo')"
                :current-url="page?.image ? `/storage/${page.image}` : null"
            />
            <div class="grid gap-2">
                <Label>{{ t('admin.pages.seo_title') }}</Label
                ><Input
                    name="meta_title"
                    :default-value="page?.meta_title ?? ''"
                />
            </div>
            <div class="grid gap-2">
                <Label>{{ t('admin.pages.seo_description') }}</Label
                ><Input
                    name="meta_description"
                    :default-value="page?.meta_description ?? ''"
                />
            </div>
            <div class="grid gap-2">
                <Label>{{ t('admin.common.order') }}</Label
                ><Input
                    type="number"
                    name="sort_order"
                    :default-value="page?.sort_order ?? 0"
                />
            </div>
            <Label class="flex items-center gap-2">
                <input
                    type="hidden"
                    name="is_published"
                    :value="isPublished ? '1' : '0'"
                />
                <Checkbox v-model="isPublished" />
                {{ t('admin.common.published') }}
            </Label>
            <div class="flex gap-2">
                <Button type="submit" :disabled="processing">{{
                    t('common.save')
                }}</Button
                ><Button variant="outline" as-child
                    ><Link href="/admin/pages">{{
                        t('common.back')
                    }}</Link></Button
                >
            </div>
        </Form>
    </div>
</template>
