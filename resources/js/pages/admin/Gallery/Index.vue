<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import { useTranslation } from '@/composables/useTranslation';
import type { GalleryItem } from '@/types/site';

defineProps<{ items: GalleryItem[] }>();
const { t } = useTranslation();
const destroy = (id: number) => {
    if (confirm(t('admin.common.delete_confirm'))) {
        router.delete(`/admin/gallery/${id}`);
    }
};
</script>
<template>
    <Head :title="t('admin.gallery.title')" />
    <div class="space-y-6 p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ t('admin.gallery.title') }}</h1>
            <Button as-child
                ><Link href="/admin/gallery/create"
                    ><Plus class="mr-2 size-4" />{{
                        t('admin.common.add')
                    }}</Link
                ></Button
            >
        </div>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div
                v-for="item in items"
                :key="item.id"
                class="overflow-hidden rounded-lg border"
            >
                <img
                    :src="`/storage/${item.image}`"
                    class="aspect-square object-cover"
                />
                <div class="flex items-center justify-between p-2">
                    <span class="truncate text-sm">{{ item.title }}</span>
                    <div class="flex">
                        <Button size="sm" variant="ghost" as-child
                            ><Link :href="`/admin/gallery/${item.id}/edit`"
                                ><Pencil class="size-4" /></Link></Button
                        ><Button
                            size="sm"
                            variant="ghost"
                            @click="destroy(item.id)"
                            ><Trash2 class="text-destructive size-4"
                        /></Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
