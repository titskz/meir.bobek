<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import { useTranslation } from '@/composables/useTranslation';
import type { CmsPage } from '@/types/site';

defineProps<{ pages: CmsPage[] }>();
const { t } = useTranslation();

const destroy = (id: number) => {
    if (confirm(t('admin.common.delete_confirm'))) {
        router.delete(`/admin/pages/${id}`);
    }
};
</script>

<template>
    <Head :title="t('admin.pages.title')" />
    <div class="space-y-6 p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ t('admin.pages.title') }}</h1>
            <Button as-child
                ><Link href="/admin/pages/create"
                    ><Plus class="mr-2 size-4" />{{
                        t('admin.common.add')
                    }}</Link
                ></Button
            >
        </div>
        <div class="overflow-hidden rounded-lg border">
            <table class="w-full text-sm">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="p-3 text-left">
                            {{ t('admin.common.title') }}
                        </th>
                        <th class="p-3 text-left">URL</th>
                        <th class="p-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in pages" :key="page.id" class="border-t">
                        <td class="p-3">{{ page.title }}</td>
                        <td class="text-muted-foreground p-3">
                            /{{ page.slug }}
                        </td>
                        <td class="p-3 text-right">
                            <Button variant="ghost" size="sm" as-child
                                ><Link :href="`/admin/pages/${page.id}/edit`"
                                    ><Pencil class="size-4" /></Link
                            ></Button>
                            <Button
                                variant="ghost"
                                size="sm"
                                @click="destroy(page.id)"
                                ><Trash2 class="text-destructive size-4"
                            /></Button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
