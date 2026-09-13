import type translations from '../../../lang/ru.json';

export type TranslationKey = keyof typeof translations;

export type Replacements = Record<string, string>;
