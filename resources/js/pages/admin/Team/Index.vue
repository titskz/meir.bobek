<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import { useTranslation } from '@/composables/useTranslation';
import type { TeamMember } from '@/types/site';

defineProps<{ members: TeamMember[] }>();
const { t } = useTranslation();
const destroy = (id: number) => {
    if (confirm(t('admin.common.delete_confirm'))) {
        router.delete(`/admin/team/${id}`);
    }
};
</script>
<template>
    <Head :title="t('admin.team.title')" />
    <div class="space-y-6 p-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ t('admin.team.title') }}</h1>
            <Button as-child
                ><Link href="/admin/team/create"
                    ><Plus class="mr-2 size-4" />{{
                        t('admin.common.add')
                    }}</Link
                ></Button
            >
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="m in members"
                :key="m.id"
                class="flex items-center gap-4 rounded-lg border p-4"
            >
                <img
                    v-if="m.image"
                    :src="`/storage/${m.image}`"
                    class="size-16 rounded-full object-cover"
                />
                <div class="flex-1">
                    <div class="font-semibold">{{ m.name }}</div>
                    <div class="text-muted-foreground text-sm">
                        {{ m.position }}
                    </div>
                    <div class="text-xs">
                        {{ t('admin.common.order') }}: {{ m.sort_order }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <Button size="sm" variant="ghost" as-child
                        ><Link :href="`/admin/team/${m.id}/edit`"
                            ><Pencil class="size-4" /></Link></Button
                    ><Button size="sm" variant="ghost" @click="destroy(m.id)"
                        ><Trash2 class="text-destructive size-4"
                    /></Button>
                </div>
            </div>
        </div>
    </div>
</template>
