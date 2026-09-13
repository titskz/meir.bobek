<script setup lang="ts">
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const props = withDefaults(
    defineProps<{
        label?: string;
        currentUrl?: string | null;
        name?: string;
    }>(),
    { name: 'image' },
);

const preview = ref<string | null>(null);

const onChange = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];

    if (file) {
        preview.value = URL.createObjectURL(file);
    }
};
</script>

<template>
    <div class="grid gap-2">
        <Label v-if="label">{{ label }}</Label>
        <div
            v-if="preview || currentUrl"
            class="overflow-hidden rounded-lg border"
        >
            <img
                :src="preview || currentUrl || ''"
                alt=""
                class="h-40 w-full object-cover"
            />
        </div>
        <Input
            type="file"
            accept="image/*"
            :name="props.name"
            @change="onChange"
        />
    </div>
</template>
