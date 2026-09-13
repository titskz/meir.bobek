<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import { useTranslation } from '@/composables/useTranslation';
import type { CmsGroup } from '@/types/site';

defineProps<{ groups: CmsGroup[] }>();
const { t } = useTranslation();
const destroy = (id: number) => {
    if (confirm(t('admin.common.delete_confirm'))) {
        router.delete(`/admin/groups/${id}`);
    }
};
</script>
<template>
    <Head :title="t('admin.groups.title')" />
    <div class="space-y-6 p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ t('admin.groups.title') }}</h1>
            <Button as-child
                ><Link href="/admin/groups/create"
                    ><Plus class="mr-2 size-4" />{{
                        t('admin.common.add')
                    }}</Link
                ></Button
            >
        </div>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div v-for="g in groups" :key="g.id" class="rounded-lg border p-4">
                <img
                    v-if="g.image"
                    :src="`/storage/${g.image}`"
                    class="mb-3 h-32 w-full rounded object-cover"
                />
                <h3 class="font-semibold">{{ g.title }}</h3>
                <div class="mt-3 flex gap-2">
                    <Button size="sm" variant="outline" as-child
                        ><Link :href="`/admin/groups/${g.id}/edit`"
                            ><Pencil class="size-4" /></Link></Button
                    ><Button size="sm" variant="ghost" @click="destroy(g.id)"
                        ><Trash2 class="text-destructive size-4"
                    /></Button>
                </div>
            </div>
        </div>
    </div>
</template>
