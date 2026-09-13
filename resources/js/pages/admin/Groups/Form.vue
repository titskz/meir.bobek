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
import type { CmsGroup } from '@/types/site';

const props = defineProps<{ group: CmsGroup | null }>();
const { t } = useTranslation();
const content = ref(props.group?.content ?? '');
const isActive = ref(props.group?.is_active ?? true);
const isEdit = !!props.group;
</script>
<template>
    <Head :title="isEdit ? t('admin.groups.edit') : t('admin.groups.new')" />
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <h1 class="text-2xl font-bold">
            {{ isEdit ? t('admin.groups.edit') : t('admin.groups.new') }}
        </h1>
        <Form
            :action="isEdit ? `/admin/groups/${group!.id}` : '/admin/groups'"
            :method="isEdit ? 'put' : 'post'"
            enctype="multipart/form-data"
            class="space-y-4"
            v-slot="{ processing }"
        >
            <div class="grid gap-2">
                <Label>{{ t('admin.common.title') }}</Label
                ><Input name="title" :default-value="group?.title" required />
            </div>
            <div class="grid gap-2">
                <Label>{{ t('admin.common.url') }}</Label
                ><Input
                    name="slug"
                    :default-value="group?.slug"
                    placeholder="kishkentaylar"
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
                :current-url="group?.image ? `/storage/${group.image}` : null"
            />
            <div class="grid gap-2">
                <Label>{{ t('admin.common.order') }}</Label
                ><Input
                    type="number"
                    name="sort_order"
                    :default-value="group?.sort_order ?? 0"
                />
            </div>
            <Label class="flex items-center gap-2">
                <input
                    type="hidden"
                    name="is_active"
                    :value="isActive ? '1' : '0'"
                />
                <Checkbox v-model="isActive" />
                {{ t('admin.common.active') }}
            </Label>
            <div class="flex gap-2">
                <Button type="submit" :disabled="processing">{{
                    t('common.save')
                }}</Button
                ><Button variant="outline" as-child
                    ><Link href="/admin/groups">{{
                        t('common.back')
                    }}</Link></Button
                >
            </div>
        </Form>
    </div>
</template>
