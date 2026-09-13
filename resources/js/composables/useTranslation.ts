import { usePage } from '@inertiajs/vue3';
import { computed, watchEffect } from 'vue';
import type { Replacements, TranslationKey } from '@/types/translations';

export function useTranslation() {
    const page = usePage();

    const locale = computed(() =>
        typeof page.props.locale === 'string' ? page.props.locale : 'ru',
    );

    const locales = computed(
        () => (page.props.locales as Record<string, string> | undefined) ?? {},
    );

    const t = (
        key: TranslationKey,
        replacements: Replacements = {},
    ): string => {
        const translations = page.props.translations as Record<string, string>;
        let translation = translations?.[key];

        if (translation === undefined) {
            if (import.meta.env.DEV) {
                console.warn(`[i18n] Missing translation key: ${key}`);
            }

            translation = key;
        }

        for (const [placeholder, value] of Object.entries(replacements)) {
            translation = translation.replaceAll(`:${placeholder}`, value);
        }

        return translation;
    };

    watchEffect(() => {
        if (typeof document !== 'undefined') {
            document.documentElement.lang = locale.value;
        }
    });

    return { t, locale, locales };
}
