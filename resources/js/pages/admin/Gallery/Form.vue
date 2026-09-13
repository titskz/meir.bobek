<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import ImageUpload from '@/components/admin/ImageUpload.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useTranslation } from '@/composables/useTranslation';
import type { GalleryItem } from '@/types/site';

const props = defineProps<{ item: GalleryItem | null }>();
const { t } = useTranslation();
const isActive = ref(props.item?.is_active ?? true);
const isEdit = !!props.item;
</script>
<template>
    <Head :title="isEdit ? t('admin.gallery.edit') : t('admin.gallery.new')" />
    <div class="mx-auto max-w-xl space-y-6 p-6">
        <h1 class="text-2xl font-bold">
            {{ isEdit ? t('admin.gallery.edit') : t('admin.gallery.new') }}
        </h1>
        <Form
            :action="isEdit ? `/admin/gallery/${item!.id}` : '/admin/gallery'"
            :method="isEdit ? 'put' : 'post'"
            enctype="multipart/form-data"
            class="space-y-4"
            v-slot="{ processing }"
        >
            <div class="grid gap-2">
                <Label>{{ t('admin.common.title') }}</Label
                ><Input name="title" :default-value="item?.title" required />
            </div>
            <ImageUpload
                name="image"
                :label="t('admin.common.photo')"
                :current-url="item?.image ? `/storage/${item.image}` : null"
            />
            <div class="grid gap-2">
                <Label>{{ t('admin.common.order') }}</Label
                ><Input
                    type="number"
                    name="sort_order"
                    :default-value="item?.sort_order ?? 0"
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
                }}</Button>
                <Button variant="outline" as-child
                    ><Link href="/admin/gallery">{{
                        t('common.back')
                    }}</Link></Button
                >
            </div>
        </Form>
    </div>
</template>
